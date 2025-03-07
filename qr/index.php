<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR Code Data Display</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
  <style>
    #reader {
      width: 100%;
      height: 400px;
      margin: 0 auto;
      border: 2px solid #ddd;
      border-radius: 10px;
      transform: scaleX(-1); /* Invert the camera view */
    }
    .result {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center">QR Code Data Display</h2>
    <video id="reader" style="width: 100%; height: 400px;"></video>
    <div id="result" class="result text-center mt-3">
      <p><strong>Scanned QR Data:</strong></p>
      <p id="scannedData">No data detected</p>
    </div>
  </div>

  <script>
    const videoElement = document.getElementById("reader");
    const resultElement = document.getElementById("scannedData");

    function onScanSuccess(decodedText) {
      // Display the QR code data
      resultElement.textContent = decodedText;
    }

    // Start the video stream and QR scanning
    function startScanning() {
      navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
        .then(stream => {
          videoElement.srcObject = stream;
          videoElement.setAttribute("playsinline", true); // Required for iPhone

          videoElement.onloadedmetadata = function() {
            // Ensure video has loaded metadata and dimensions are set
            videoElement.play();
            scanQRCode(); // Start scanning when the video is ready
          };
        })
        .catch(err => {
          console.log("Error accessing camera:", err);
          resultElement.textContent = "Failed to access camera.";
        });
    }

    // Function to scan QR code using jsQR
    function scanQRCode() {
      const canvas = document.createElement("canvas");
      const context = canvas.getContext("2d");

      // Ensure the video has dimensions before trying to get the image data
      if (videoElement.videoWidth === 0 || videoElement.videoHeight === 0) {
        requestAnimationFrame(scanQRCode); // Wait until the video has proper dimensions
        return;
      }

      // Set canvas dimensions to match video size
      canvas.width = videoElement.videoWidth;
      canvas.height = videoElement.videoHeight;

      // Draw the current video frame to the canvas
      context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

      // Get image data from the canvas
      const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
      const code = jsQR(imageData.data, canvas.width, canvas.height);

      // If a QR code is found, display its data
      if (code) {
        onScanSuccess(code.data);
      } else {
        requestAnimationFrame(scanQRCode); // Continue scanning if no QR code is detected
      }
    }

    // Initialize scanning when the page loads
    window.onload = startScanning;
  </script>
</body>
</html>
