let dropArea = document.getElementById('drop-area');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
  e.preventDefault();
  e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
  dropArea.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, unHighlight, false);
});

function highlight(e) {
  console.log('highlight');
  dropArea.classList.add('highlight');
}

function unHighlight(e) {
  console.log('unHighlight');
  dropArea.classList.remove('highlight');
}

dropArea.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
  let dt = e.dataTransfer;
  let files = dt.files;

  handleFiles(files);
}

function handleFiles(files) {
  ([...files]).forEach(uploadFile);
}

function uploadFile(file) {
  let reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onloadend = function() {
    let base64String = reader.result.split(',')[1];
    let url = '/api/upload';
    let data = JSON.stringify({
      file: base64String,
      name: file.name,
    });

    fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: data,
    }).then(response => response.json()).then(data => {
      document.getElementById('response').innerHTML = JSON.stringify(data);
    }).catch(() => {
      document.getElementById('response').innerHTML = 'Error al subir el archivo';
    });
  };
}
