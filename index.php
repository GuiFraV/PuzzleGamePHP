<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a puzzle Game</title>
</head>
<body>

    <style>
        .canvas-holder{
            margin: auto;
            margin-top: 50px;
            width: 100%;
            max-width: 800px;
            background-color: #eee;
            display:flex;
        }
        .canvas{
            border: solid thin #888;
            width: 600px;
            height: 600px;
            flex:1;
        }
   
        .cropped-images{
            background-color: red;
            flex: 1;
        }

        .btn{
            padding:10px;
            border: solid thin #888;
            cursor: pointer;
            display: inline-block;
        }
    </style>

    <div class="canvas-holder">
        <canvas class="canvas"></canvas>
        <div class="cropped-images">
            <div class="controls">
                <label>
                    <input onChange="addImage(this.files[0])" class="image-input" type="file" name="image" style="display:none">
                    <div class="btn">Load Image</div>
                </label>
            </div>
            <div class="images"></div>
        </div>
    </div>

    
</body>
</html>

<script>

    const canvas = document.querySelector('.canvas');
    const ctx = canvas.getContext('2d');
    canvas.width = 600;
    canvas.height = 600;
    const cropped_images_div = document.querySelector('.cropped-images');

    canvas.addEventListener('mousemove', mousemoved);
    canvas.addEventListener('mousedown', mousedown);
    window.addEventListener('mouseup', mouseup);

    let mouseIsDown = false;
    let imageAdded = false;
    let mouseDownPos = {x:0, y:0};
    let mainImage = null;
    let tempBox = {};

    function mousemoved(e){
        if(mouseIsDown){

            if(!imageAdded){
                alert("Please add an image first !");
                return;
            }
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            redraw();
            let width = (e.clientX - canvas.offsetLeft) - mouseDownPos.x;
            let height = (e.clientY - canvas.offsetTop) - mouseDownPos.y;
            ctx.strokeStyle = "grey";
            ctx.strokeRect(mouseDownPos.x, mouseDownPos.y, width, height);

            // save temp box params
            tempBox.x = mouseDownPos.x;
            tempBox.y = mouseDownPos.y;
            tempBox.width = width;
            tempBox.height = height;
        }
    }

    function mousedown(e){
        
        mouseIsDown = true;
        mouseDownPos = {
            x:e.clientX - canvas.offsetLeft, 
            y:e.clientY - canvas.offsetTop
        };

    }

    function mouseup(e){ 
        mouseIsDown = false;
    }

    function addImage(file){

        let img = new Image();
        img.src = URL.createObjectURL(file);
        
        img.onload = function(){
            imageAdded = true;
            let height = img.naturalHeight / img.naturalWidth;
            ctx.drawImage(img, 0, 0, canvas.width, height * canvas.width);
            mainImage = img;
        }
    }

    function redraw(){
        if(mainImage){

            let height = mainImage.naturalHeight / mainImage.naturalWidth;
            ctx.drawImage(mainImage, 0, 0, canvas.width, height * canvas.width);
        }
    }

</script>