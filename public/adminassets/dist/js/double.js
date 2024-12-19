const fileInputs = document.querySelectorAll("input[type='file']");
    const fileSelects = document.querySelectorAll(".uploader");

    fileSelects.forEach((fileSelect, index) => {
        fileSelect.addEventListener("click", () => {
            fileInputs[index].click();
        });
        fileSelect.addEventListener("dragenter", stopEvent, false);
        fileSelect.addEventListener("dragover", stopEvent, false);
        fileSelect.addEventListener("drop", e => drop(e, index), false);
        fileInputs[index].addEventListener("change", e => {
            clearImgList(index);
            handleFiles(e.target.files, index);
        }, false);
    });

    function drop(e, index) {
        e.stopPropagation();
        e.preventDefault();
        const files = e.dataTransfer.files;
        clearImgList(index);
        handleFiles(files, index);
    }

    function stopEvent(e) {
        e.stopPropagation();
        e.preventDefault();
    }

    function handleFiles(files, index) {
        const content = document.getElementById(`content${index + 1}`);
        const contentAction = document.querySelector(`#content-action${index + 1}`);
        const nodeToReplace =
            contentAction !== null
                ? contentAction
                : document.querySelector(`#content${index + 1} .uploaded-img`);
        if (files.length > 0 && files[0].type.startsWith("image/")) {
            const img = document.createElement("img");
            img.src = window.URL.createObjectURL(files[0]);
            img.classList.add("uploaded-img");
            img.onload = function () {
                window.URL.revokeObjectURL(this.src);
            };
            content.replaceChild(img, nodeToReplace);
        }

        if (files.length > 1) {
            const oit = document.querySelector(`#oit${index + 1}`);
            for (let i = 1; i < files.length; i++) {
                if (files[i].type.startsWith("image/")) {
                    const divImg = document.createElement("div");
                    divImg.classList.add("img-list");
                    const img = document.createElement("img");
                    img.src = window.URL.createObjectURL(files[i]);
                    img.classList.add("img-thumb");
                    img.onload = function () {
                        window.URL.revokeObjectURL(this.src);
                    };
                    divImg.appendChild(img);
                    oit.appendChild(divImg);
                }
            }
        }
    }

    function clearImgList(index) {
        const imgList = document.querySelectorAll(`#oit${index + 1} .img-list`);
        if (imgList.length > 0) {
            imgList.forEach(imgDiv => {
                imgDiv.remove();
            });
        }
    }