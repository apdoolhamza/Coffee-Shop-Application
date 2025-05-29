const sidebar = document.querySelector('.sidebar');
const navBtn = document.querySelector('.navBtn');
const hideSidebarBtn = document.querySelector('.hideSidebarBtn');

navBtn.addEventListener('click', () => {
    sidebar.style.display = "block";
})
function hideSideBar() {
    sidebar.style.display = "none";
}
hideSidebarBtn.addEventListener('click', () => {
    hideSideBar();
})
document.addEventListener('mouseup', hideSideBar);