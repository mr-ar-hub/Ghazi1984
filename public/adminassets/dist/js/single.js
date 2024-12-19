const fileInput = document.getElementById("fileInput");
    const fileSelect = document.getElementById("fileSelect");

    fileSelect.addEventListener("click", e => {
    fileInput.click();
    });
    fileSelect.addEventListener("dragenter", stopEvent, false);
    fileSelect.addEventListener("dragover", stopEvent, false);
    fileSelect.addEventListener("drop", drop, false);
    fileInput.addEventListener(
    "change",
    e => {
        clearImgList();
        handleFiles(e.target.files);
    },
    false
    );

    function drop(e) {
    e.stopPropagation();
    e.preventDefault();
    const files = e.dataTransfer.files;
    clearImgList();
    handleFiles(files);
    }
    function stopEvent(e) {
    e.stopPropagation();
    e.preventDefault();
    }
    function handleFiles(files) {
    const content = document.getElementById("content");
    const contentAction = document.querySelector("#content-action");
    const nodeToReplace =
        contentAction !== null
        ? contentAction
        : document.querySelector(".uploaded-img");
    if (files.length > 0 && files[0].type.startsWith("image/")) {
        const img = document.createElement("img");
        img.src = window.URL.createObjectURL(files[0]);
        img.classList.add("uploaded-img");
        img.onload = function() {
        window.URL.revokeObjectURL(this.src);
        };
        content.replaceChild(img, nodeToReplace);
    }

    if (files.length > 1) {
        // where oit is other image thumbnails
        const oit = document.querySelector("#oit");
        for (let i = 1; i < files.length; i++) {
        if (files[i].type.startsWith("image/")) {
            const divImg = document.createElement("div");
            divImg.id = "img-list";
            const img = document.createElement("img");
            img.src = window.URL.createObjectURL(files[i]);
            img.classList.add("img-thumb");
            img.onload = function() {
            window.URL.revokeObjectURL(this.src);
            };
            divImg.appendChild(img);
            oit.appendChild(divImg);
        }
        }
    }
    }

    function clearImgList() {
    const imgList = document.querySelectorAll("#img-list");
    console.log(imgList.length);
    if (imgList.length > 0) {
        imgList.forEach(imgDiv => {
        imgDiv.remove();
        });
    }
    }