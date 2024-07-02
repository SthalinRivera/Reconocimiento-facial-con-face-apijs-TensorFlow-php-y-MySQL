function openCamera(buttonId) {
  navigator.mediaDevices.getUserMedia({ video: true })
    .then((stream) => {
      const video = document.createElement('video');
      video.srcObject = stream;
      video.classList.add('camera-container'); // Agregar la clase para estilos

    //  document.body.appendChild(video);

      // Busca el contenido del modal y añade el video allí
      const modalContent = document.querySelector('.modal-content');
      modalContent.appendChild(video);


      video.play();

      // Esperamos un poco antes de capturar las imágenes
      setTimeout(() => {
        const capturedImages = captureMultipleImages(video, 4);
        stream.getTracks().forEach(track => track.stop());
        //document.body.removeChild(video);
        modalContent.removeChild(video);
        // Mostrar las imágenes capturadas en los elementos <img>
        for (let i = 0; i < capturedImages.length; i++) {
          const imgElement = document.getElementById(`${buttonId}-captured-image`);
          if (imgElement) {
            imgElement.src = capturedImages[i];
          }
          const hiddenInput = document.getElementById(`${buttonId}-captured-image-input`);
          if (hiddenInput) {
            hiddenInput.value = capturedImages[i];
          }
        }

      }, 1000); // Captura automática después de 2 segundos
    })
    .catch((error) => {
      console.error('Error accessing webcam:', error);
    });
}

function captureMultipleImages(video, count) {
  const images = [];

  for (let i = 0; i < count; i++) {
    const canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    const context = canvas.getContext('2d');

    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    const imageDataUrl = canvas.toDataURL('image/png');
    images.push(imageDataUrl);
  }

  return images;
}
