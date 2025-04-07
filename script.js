function uploadFile() {
  const fileInput = document.getElementById("fileInput");
  const file = fileInput.files[0];

  if (!file) {
    alert("Please select a file to upload.");
    return;
  }

  const formData = new FormData();
  formData.append("file", file);

  fetch("https://file.io", {
    method: "POST",
    body: formData
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        const linkInput = document.getElementById("downloadLink");
        linkInput.value = data.link;
        document.getElementById("linkContainer").style.display = "block";
      } else {
        alert("Failed to upload file.");
      }
    })
    .catch(() => {
      alert("An error occurred while uploading.");
    });
}

function copyLink() {
  const copyText = document.getElementById("downloadLink");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");
  alert("Link copied to clipboard!");
}
