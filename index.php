<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a puzzle Game</title>
</head>
<body>

    <style>
        .canvas{
            border: solid thin #888;
            width: 500px;
            height: 500px;
        }
        .canvas-holder{
            margin: auto;
            margin-top: 50px;
            width: 100%;
            max-width: 800px;
            background-color: #eee;
        }
    </style>

    <div class="canvas-holder">
        <canvas class="canvas">
    </div>

    </canvas>
    
</body>
</html>

<script>

    const canvas = document.querySelector('.canvas');
    const ctx = canvas.getContext('2d');

    canvas.addEventListener('mousemove', mousemoved);
    canvas.addEventListener('mousedown', mousedown);
    canvas.addEventListener('mouseup', mouseup);

    let mouseIsDown = false;

    function mousemoved(e){
        if(mouseIsDown){
            console.log(e);
        }
    }

    function mousedown(e){
        
        mouseIsDown = true;
        console.log("mouseDown" + e.target);
    }

     function mouseup(e){
        
        mouseIsDown = false;
        console.log("mouseUp" + e.target);
    }

</script>