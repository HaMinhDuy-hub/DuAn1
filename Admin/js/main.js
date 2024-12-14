var img = [];
for (var i = 0; i < 4; i++) {
    img[i] = new Image();
    img[i].src = "./img/anh" + i + ".JPG";
}

var index = 0; // Khai báo index sử dụng 'var' hoặc 'let' để tránh tạo biến toàn cục

var interval = setInterval(slideshow, 2000);

function slideshow() {
    index++;
    if (index >= img.length) {
        index = 0;
    }
    document.getElementById("banner").src = img[index].src;
}

function next() {
    index++;
    if (index >= img.length) {
        index = 0;
    }
    document.getElementById("banner").src = img[index].src;
}

function pre() {
    index--;
    if (index < 0) {
        index = img.length - 1;
    }
    document.getElementById("banner").src = img[index].src;
}
