function init() {
    //return new Promise((resolve, reject) => {
        require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs' }});
        require(['vs/editor/editor.main'], function() {
            window.editor = monaco.editor.create(document.getElementById('editor-container'), {
                value:  
                "@startuml\nAlice -> Bob: Authentication Request\nBob --> Alice: Authentication Response\n\nAlice -> Bob: Another authentication Request\nAlice <-- Bob: Another authentication Response\n@enduml",
                language: 'planttext'
            });
            //resolve(window.editor);
            ViewPreview('svg');
            window.editor.onDidChangeModelContent(async () => {
                data = await ViewPreview('svg');
                const previewContainer = document.getElementById('preview-container');
                previewContainer.innerHTML = data['image'];
            })
        });
    //})
};


async function ViewPreview(type) {
    const editorValue = window.editor.getValue();
    try {
        const responce = await fetch('/umlEncode.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ uml: editorValue, type: type })
        })
        const data = await responce.json();
        return data;

    } catch (err) {
        console.error(err);
    }
    
}


function ploblemListHandler() {
    document.addEventListener('DOMContentLoaded', function () {
        const basePath = '/Pages/ploblem.php?';
        const ploblemsItem = document.querySelectorAll('.ploblem-item');
        
        ploblemsItem.forEach(item => {
            item.addEventListener('click', function ()  {
                const ploblemId = this.getAttribute('data-id');
                window.location.href = `${basePath}id=${ploblemId}`;
            })
        });

    })
}

async function getSvg() {
    data = await ViewPreview('svg');
    if (!data) {
        console.error('no svg data found');
    }
    return data['image'];
}

async function getPng() {
    data = await ViewPreview('png');
    if (!data) {
        console.error('no png data found');
    }
    return data['image'];
}

async function getAscii() {
    data = await ViewPreview('ascii');
    if (!data) {
        console.error('no ascii data found');
    }
    return data['image'];
}


function setPreviewImage(el, image, format) {
    const previewImage = document.querySelector('#preview-image');
    if (previewImage) {
        previewImage.remove();
    }

    if (format == 'ascii') {
        el.innerHTML = `<pre id='preview-image'> ${image}</pre>`;
    } else if (format == 'svg') {
        el.innerHTML = `<div id='preview-image'>${image}</div>`;
    } else if (format == 'png') {
        image.id = 'preview-image';
        el.appendChild(image);
    }

    el.dataset.format = format;
}

function processPreviewImage() {
    const btns = document.querySelectorAll('.previewBtn');
    const previewContainer = document.getElementById('preview-container');
    let image = null;
    btns.forEach(btn => {
        btn.addEventListener('click', async function () {
            switch (btn.id) {
                case 'btnSvg':
                    console.log('ps: svg');
                    image = await getSvg();
                    setPreviewImage(previewContainer, image, 'svg');
                    break;
                case 'btnPng':
                    console.log('ps: png');
                    image = await getPng();
                    const img = document.createElement('img');
                    img.src = `data:image/png;base64,${image}`;
                    setPreviewImage(previewContainer, img, 'png');
                    break;
                case 'btnAscii':
                    console.log('ps: ascii');
                    image = await getAscii();
                    setPreviewImage(previewContainer, image, 'ascii');
                    break;
            }
        })
    })
}

function downloadImage() {
    const downloadBtn = document.getElementById('btnDownload');

    downloadBtn.addEventListener('click', async function() {
        console.log('click');
        const previewContainer = document.getElementById('preview-container');
        const format = previewContainer.dataset.format;
        let image = null;
        let fileName = 'output';
        switch (format) {
            case 'ascii':
                const txt  = await getAscii();
                image = new Blob([txt], {type: 'text/plan'});
                fileName += '.txt';
                break;

            case 'png':
                const png = await getPng();
                const binaryString = atob(png);
                const len = binaryString.length;
                const bytes = new Uint8Array(len);
                for (let i = 0; i < len; i++) {
                    bytes[i] = binaryString.charCodeAt(i);
                }

                image = new Blob([bytes], { type: 'image/png' });
                fileName += '.png';
                break;

            case "svg":
                const svg = await getSvg();
                console.log(svg);
                fileName += '.svg';
                image = new Blob([svg], { type: 'image/svg+xml' });
                console.log(image);
                break;
        }

        createDownloadClick(image, fileName);
    })
}

function createDownloadClick(downloadImage, fileName) {
    const url = URL.createObjectURL(downloadImage);
    const a = document.createElement('a');
    a.href = url;
    a.download = fileName;
    document.body.append(a);
    a.click();
    document.body.remove(a);
    URL.revokeObjectURL(url);
}

function main() {
    /*
    init().then(editor => {
        ViewPreview();
    })
    */
   init();
    ploblemListHandler();
    processPreviewImage();
    downloadImage();
}

main();