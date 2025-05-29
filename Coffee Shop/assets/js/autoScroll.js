const autoscroll = document.querySelector('.autoscroll');

let isDragStart = false,
isDragging = false,
prevPageX,
prevScrollLeft,
positionDiff;

const dragStart = (e) => {
    isDragStart = true;
    prevPageY = e.pageY;
    prevScrollLeft = autoscroll.scrollTop;
}
const dragging = (e) => {
    if(!isDragStart) return;
    e.preventDefault();
    isDragging = true;
    positionDiff = e.pageY - prevPageY;
    autoscroll.scrollTop = prevScrollLeft - positionDiff;
}
const dragStop = () => {
    isDragStart = false;
    if(!isDragging) return;
    isDragging = false;
}
autoscroll.addEventListener("mousedown", dragStart);
document.addEventListener("mousemove", dragging);
document.addEventListener("mouseup", dragStop);
