const historyBack = document.querySelector('.historyBack');

historyBack.addEventListener('click',() => {
    // back the browser history(one page back)
    history.back();
})