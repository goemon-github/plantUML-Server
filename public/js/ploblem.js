async function getPloblemContent() {
    const id = getQueryParam('id');
    const ploblemJson = await fetchGetJson('ploblems.json');

    let targetPloblem = null;
    Object.values(ploblemJson).forEach(ploblem =>  {
        if (ploblem['id'] == id) {
            targetPloblem = ploblem;
        }
    })
    return targetPloblem;


}

function fetchGetJson(fileName) {
    return fetch('/' + fileName)
        .then(responce => {
            return responce.json();
        })
        .catch(err => console.log(err));
}

function fetchGetSvg(id, umlText) {
    return fetch('/umlEncode.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ uml: umlText })
    })
    .then(response => response.json())
    .then(data => {
        return  data['svg'];
    })
    .catch(err => {
        console.error(err);
    });

}

function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

async function viewAnswerText() {
    const ploblem = await getPloblemContent();
    const answerConteiner = document.getElementById('answer-container');
    const uml = ploblem['uml'];

    const lastChildDiv = document.querySelector('#answer');
    if (lastChildDiv) {
        lastChildDiv.remove();
    }

    const div = document.createElement('div');
    div.id = 'answer';
    div.innerText = uml;

    answerConteiner.appendChild(div);
}

async function viewAnswerSvg() {
    const ploblem = await getPloblemContent();
    const answerConteiner = document.getElementById('answer-container');
    const svg = await fetchGetSvg(ploblem['id'], ploblem['uml']);
    const lastChildDiv = document.querySelector('#answer');
    if (lastChildDiv) {
        lastChildDiv.remove();
    }

    const div = document.createElement('div');
    div.id = 'answer';
    div.innerHTML = svg;
    
    answerConteiner.appendChild(div);

}

function answerBtnClickHandler(){
    const btns = document.querySelectorAll('.answerBtn');
    btns.forEach(btn => {
        btn.addEventListener('click', function() {
            if(btn.id == 'btnHtml'){
               viewAnswerText();
                downloadImage();
            }else if(btn.id == 'btnSvg'){
                viewAnswerSvg();
            }

        })
    })
}


function downloadImage() {
    const svg = document.querySelector('#preview-container svg');
}



async function main() {
    answerBtnClickHandler();
}

main();