var filechooser = document.getElementById('filechooser');
var previewer = document.getElementById('previewer');

filechooser.onchange = function() {
    var files = this.files;
    var file = files[0];

    // 接受 jpeg, jpg, png 类型的图片
    if (!/\/(?:jpeg|jpg|png)/i.test(file.type)) return;

    var reader = new FileReader();

    reader.onload = function() {
        var result = this.result;

        previewer.src = result;

        // 清空图片上传框的值
        filechooser.value = '';
    };

    reader.readAsDataURL(file);
};/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var filechooser = document.getElementById('filechooser');
var previewer = document.getElementById('previewer');

// 200 KB 对应的字节数
var maxsize = 200 * 1024;

filechooser.onchange = function() {
    var files = this.files;
    var file = files[0];

    // 接受 jpeg, jpg, png 类型的图片
    if (!/\/(?:jpeg|jpg|png)/i.test(file.type)) return;

    var reader = new FileReader();
    reader.onload = function() {
        var result = this.result;
        var img = new Image();

        // 如果图片小于 200kb，不压缩
        if (result.length <= maxsize) {
            toPreviewer(result);
            return;
        }

        img.onload = function() {
            var compressedDataUrl = compress(img, file.type);
            toPreviewer(compressedDataUrl);
            img = null;
        };

        img.src = result;
    };

    reader.readAsDataURL(file);
};

function toPreviewer(dataUrl) {
    previewer.src = dataUrl;
    filechooser.value = '';
}

function compress(img, fileType) {
    var canvas = document.createElement("canvas");
    var ctx = canvas.getContext('2d');

    var width = img.width;
    var height = img.height;

    canvas.width = width;
    canvas.height = height;

    ctx.fillStyle = "#fff";
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.drawImage(img, 0, 0, width, height);

    // 压缩
    var base64data = canvas.toDataURL(fileType, 0.75);
    canvas = ctx = null;

    return base64data;
}

