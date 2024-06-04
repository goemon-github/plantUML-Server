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

function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

function viewAnswerText(ploblem) {
    const answerConteiner = document.getElementById('answer-container');
    const uml = ploblem['uml'];

    answerConteiner.innerText = uml;
}

function viewAnswerSvg(ploblem) {
    const answerConteiner = document.getElementById('answer-container');

}


async function main() {
    const ploblem = await getPloblemContent();
    console.log(ploblem);
    viewAnswerText(ploblem);
}

main();