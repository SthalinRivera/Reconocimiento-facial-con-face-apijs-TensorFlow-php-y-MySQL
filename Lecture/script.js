
var labels = [];
let detectedFaces = [];
let sendingData = false;

function updateTable() {

    //Selecciona todo los usuarios registrado en db con "IS"
    var selectedCourseID = "IS";

    console.log(selectedCourseID);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'lecture/manageFolder.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                labels = response.data;
                updateOtherElements();
            } else {
                console.error('Error:', response.message);
            }
        }
    };
    xhr.send('courseID=' + encodeURIComponent(selectedCourseID));
}

function markAttendance(detectedFaces) {
    if (detectedFaces[0] != null && detectedFaces[0] !== '') {
        studentID = detectedFaces[0];
        sendAttendanceDataForStudent({
            studentID: studentID,
            attendanceStatus: 'presente'
        });
    }
}

function sendAttendanceDataForStudent(attendanceData) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', './lecture/attendanceUpload.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                console.log('Attendance recorded successfully for student ID:', attendanceData.studentID);
            } else {
                console.log('Error: Unable to record attendance for student ID:', attendanceData.studentID);
            }
        }
    };
    xhr.send(JSON.stringify([attendanceData]));
}




function updateOtherElements() {

    const video = document.getElementById("video");
    const videoContainer = document.querySelector(".video-container");
    let webcamStarted = false;
    let modelsLoaded = false;


    Promise.all([
        faceapi.nets.ssdMobilenetv1.loadFromUri("http://localhost/face/models"),
        faceapi.nets.faceRecognitionNet.loadFromUri("http://localhost/face/models"),
        faceapi.nets.faceLandmark68Net.loadFromUri("http://localhost/face/models"),
    ]).then(() => {
        modelsLoaded = true;
    });
    videoContainer.style.display = "flex";
    if (!webcamStarted) {
        startWebcam();
        webcamStarted = true;
    }

    function startWebcam() {
        navigator.mediaDevices
            .getUserMedia({
                video: true,
                audio: false,
            })
            .then((stream) => {
                video.srcObject = stream;
                videoStream = stream;
            })
            .catch((error) => {
                console.error(error);
            });

    }

    async function getLabeledFaceDescriptions() {
        const labeledDescriptors = [];

        for (const label of labels) {
            const descriptions = [];

            for (let i = 1; i <= 2; i++) {
                try {
                    const img = await faceapi.fetchImage(`./lecture/labels/${label}/${i}.png`);
                    const detections = await faceapi
                        .detectSingleFace(img)
                        .withFaceLandmarks()
                        .withFaceDescriptor();

                    if (detections) {
                        descriptions.push(detections.descriptor);
                    } else {
                        console.log(`No face detected in ${label}/${i}.png`);
                    }
                } catch (error) {
                    console.error(`Error processing ${label}/${i}.png:`, error);
                }
            }

            if (descriptions.length > 0) {
                detectedFaces.push(label);
                labeledDescriptors.push(new faceapi.LabeledFaceDescriptors(label, descriptions));
            }
        }

        return labeledDescriptors;

    }


    video.addEventListener("play", async () => {
        const labeledFaceDescriptors = await getLabeledFaceDescriptions();
        const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors);
        const canvas = faceapi.createCanvasFromMedia(video);
        videoContainer.appendChild(canvas);

        const displaySize = { width: video.width, height: video.height };
        faceapi.matchDimensions(canvas, displaySize);

        setInterval(async () => {
            const detections = await faceapi
                .detectAllFaces(video)
                .withFaceLandmarks()
                .withFaceDescriptors();
            const resizedDetections = faceapi.resizeResults(detections, displaySize);
            canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
            const results = resizedDetections.map((d) => {
                return faceMatcher.findBestMatch(d.descriptor);
            });
            detectedFaces = results.map(result => result.label);
            markAttendance(detectedFaces);
            results.forEach((result, i) => {
                const box = resizedDetections[i].detection.box;
                const drawOptions = {
                    label: result.toString(),
                    boxColor: result.label === 'unknown' ? 'red' : 'green'
                };
                const drawBox = new faceapi.draw.DrawBox(box, drawOptions);
                drawBox.draw(canvas);
            });

        }, 100);
    })
};



function sendAttendanceDataToServer() {
    const attendanceData = [];
    document.querySelectorAll('#studentTableContainerPrin tr').forEach((row, index) => {
        if (index === 0) return;
        const studentID = row.cells[0].innerText.trim();
        const course = row.cells[2].innerText.trim();
        const unit = row.cells[3].innerText.trim();
        const attendanceStatus = row.cells[5].innerText.trim();
        attendanceData.push({ studentID, course, unit, attendanceStatus });
    });


    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'takeAttendance.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                showMessage('Attendance recorded successfully.');
            } else {
                showMessage('Error: Unable to record attendance.');
            }
        }
    };

    xhr.send(JSON.stringify(attendanceData));

}
function showMessage(message) {
    var messageDiv = document.getElementById('messageDiv');
    messageDiv.style.display = "block";
    messageDiv.innerHTML = message;
    console.log(message);
    messageDiv.style.opacity = 1;
    setTimeout(function () {
        messageDiv.style.opacity = 0;
    }, 5000);
}
function stopWebcam() {
    if (videoStream) {
        const tracks = videoStream.getTracks();

        tracks.forEach((track) => {
            track.stop();
        });

        video.srcObject = null;
        videoStream = null;
    }
}


