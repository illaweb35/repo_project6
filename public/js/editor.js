$('textarea').trumbowyg({
    lang: 'fr',
    autogrowOnEnter: true,
    imageWidthModalEdit: true,
    urlProtocal: true,

    btnsDef: {
        image: {
            dropdown: ['insertImage', 'base64'],
            ico: 'insertImage'
        }
    },
    btns: [
        ['viewHTML'],
        ['formatting'],
        ['strong', 'em'],
        ['link'],
        ['image'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']
    ]

});