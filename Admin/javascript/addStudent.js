document.addEventListener('DOMContentLoaded', async () => {
  await Promise.all([
    faceapi.nets.ssdMobilenetv1.loadFromUri("http://localhost/face/models"),
    faceapi.nets.faceRecognitionNet.loadFromUri("http://localhost/face/models"),
    faceapi.nets.faceLandmark68Net.loadFromUri("http://localhost/face/models"),
  ]);
});

async function openCamera(buttonId) {
  try {
    const stream = await navigator.mediaDevices.getUserMedia({ video: true });
    const video = document.createElement('video');
    video.srcObject = stream;
    video.classList.add('camera-container'); // Agregar la clase para estilos

    const modalContent = document.querySelector('.modal-content');
    modalContent.appendChild(video);

    await video.play();

    // Esperamos un poco antes de capturar las imágenes
    setTimeout(async () => {
      const capturedImages = await captureFaceImages(video, 1); // Captura una sola imagen
      stream.getTracks().forEach(track => track.stop());
      modalContent.removeChild(video);

      // Mostrar la imagen capturada en el elemento <img>
      const imgElement = document.getElementById(`${buttonId}-captured-image`);
      if (imgElement) {
        imgElement.src = capturedImages[0];
      }
      const hiddenInput = document.getElementById(`${buttonId}-captured-image-input`);
      if (hiddenInput) {
        hiddenInput.value = capturedImages[0];
      }
    }, 5000); // Captura automática después de 5 segundos
  } catch (error) {
    console.error('Error accessing webcam:', error);
  }
}

async function captureFaceImages(video, count) {
  const images = [];

  for (let i = 0; i < count; i++) {
    const canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    const context = canvas.getContext('2d');

    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    // Detectar caras en el video
    const detections = await faceapi.detectAllFaces(video, new faceapi.SsdMobilenetv1Options()).withFaceLandmarks();

    if (detections.length > 0) {
      const { x, y, width, height } = detections[0].alignedRect.box;
      const faceCanvas = document.createElement('canvas');
      faceCanvas.width = width;
      faceCanvas.height = height;
      const faceContext = faceCanvas.getContext('2d');
      faceContext.drawImage(canvas, x, y, width, height, 0, 0, width, height);

      const imageDataUrl = faceCanvas.toDataURL('image/png');
      images.push(imageDataUrl);
    }
  }

  return images;
}
