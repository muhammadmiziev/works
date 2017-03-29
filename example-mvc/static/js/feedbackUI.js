window.UI = {}
var mp = document.getElementById('markdown_preview');
var imgUploadForm = document.getElementById('upload_img_form');
var imgUploader = document.getElementById('img_uploader');
var previewUploadImg = document.getElementById('preview_upload_img');

UI.markdown = (e) => {
    mp.innerHTML = markdown.toHTML(e.value);
}

UI.uploadClick = (e) => {
    imgUploader.click();
    // console.log(imgUploader);
}
UI.uploadChange = (e) => {
    previewUploadImg.style.visibility = 'visible';
    previewUploadImg.src = UI.getObjectURL(e.files[0])
}

UI.getObjectURL = (object) => {
    return (window.URL) ? window.URL.createObjectURL(object) : window.webkitURL.createObjectURL(object);
}
