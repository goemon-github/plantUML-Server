function init() {
    return new Promise((resolve, reject) => {
        require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs' }});
        require(['vs/editor/editor.main'], function() {
            window.editor = monaco.editor.create(document.getElementById('editor-container'), {
                value:  
                "@startuml\nAlice -> Bob: Authentication Request\nBob --> Alice: Authentication Response\n\nAlice -> Bob: Another authentication Request\nAlice <-- Bob: Another authentication Response\n@enduml",
                language: 'planttext'
            });
            resolve(window.editor);
        });
    })
};


function ViewPreview() {
    const editorValue = window.editor.getValue();


    fetch('umlEncode.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ uml: editorValue })
    })
    .then(response => response.json())
    .then(data => {
        const previewContainer = document.getElementById('preview-container');
        previewContainer.innerHTML = data['svg'];
    })
    .catch(err => {
        console.error(err)
    });

}

function test() {
    fetch('test.php', {
        method: "POST",
        headers: {
            'Content-Type': 'applicaton/json',
        },
        
    })

}







function main() {
    init().then(editor => {
        ViewPreview();
    })

}

main();