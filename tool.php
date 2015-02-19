<html>
<head>
	<title>
		Annotation Tool
	</title>
	<style>
	body {
    background-color: ivory;
    padding:10px;
}
#canvas {
    border:1px solid red;
}
input[type=radio] {
    border: 0px;
    width: 100%;
    height: 1.5em;
}
	</style>

    <script src="jquery.min.js"></script>

	</head>
<canvas id="canvas" width=648 height=432 ></canvas>
<div id="forms" style="position:fixed;left:770;top:10">
<p>Red Form</p>
 <form id="red">
 <input type="radio" name="red" value="0" /> Serve<br />
 <input type="radio" name="red" value="1" /> Hit<br />
 <input type="radio" name="red" value="2" /> No Hit<br />
 </form>
<p style="margin-top:150px">Green Form</p>
 <form id="green">
 <input type="radio" name="green" value="0" /> Serve<br />
 <input type="radio" name="green" value="1" /> Hit<br />
 <input type="radio" name="green" value="2" /> No Hit<br />
 </form>
<p style="margin-top:50px"></p>
<button style='height:50px;width:80px'onclick="getdimensions()">Submit</button>
</div>
<!-- <img src="images/image1.png"></img> -->
<script>

// function getParameterByName(name) {
// var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
// return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
// }
function GetUrlValue(VarSearch){
    var SearchString = window.location.search.substring(1);
    var VariableArray = SearchString.split('&');
    for(var i = 0; i < VariableArray.length; i++){
        var KeyValuePair = VariableArray[i].split('=');
        if(KeyValuePair[0] == VarSearch){
            return KeyValuePair[1];
        }
    }
}

var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var canvasOffset = $("#canvas").offset();
var offsetX = canvasOffset.left;
var offsetY = canvasOffset.top;
var startX;
var startY;
var isDown = false;
var pi2 = Math.PI * 2;
var resizerRadius = 8;
var rr = resizerRadius * resizerRadius;

var draggingResizer = {
    x: 0,
    y: 0
};

var draggingResizer_1 = {
    x: 0,
    y: 0
};

var imageX = 50;
var imageY = 50;
var imageX_1 = 250;
var imageY_1 = 250;
var imageWidth, imageHeight, imageRight, imageBottom;
var imageWidth_1, imageHeight_1, imageRight_1, imageBottom_1;

var draggingImage = false;
var startX;
var startY;






var draggingImage_1 = false;


imageWidth = 70;
imageHeight = 100;
imageRight = 110;
imageBottom = 150;

imageWidth_1 = 70;
imageHeight_1 = 140;
imageRight_1 = 320;
imageBottom_1 = 400;

var img = new Image();
img.onload = function ()
{
    draw(true,true);
}
img.src = "images/img"+GetUrlValue('img')+".png";



img.style.zIndex="-1";


function draw(withAnchors, withBorders) {

    
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // draw the image
    ctx.drawImage(img, 0, 0, img.width, img.height, 0, 0, img.width, img.height);
    //alert (img.width);
    // optionally draw the draggable anchors
    if (withAnchors) {
        drawDragAnchor(imageX, imageY);
        drawDragAnchor(imageRight, imageY);
        drawDragAnchor(imageRight, imageBottom);
        drawDragAnchor(imageX, imageBottom);


        drawDragAnchor_1(imageX_1, imageY_1);
        drawDragAnchor_1(imageRight_1, imageY_1);
        drawDragAnchor_1(imageRight_1, imageBottom_1);
        drawDragAnchor_1(imageX_1, imageBottom_1);


    }

    // optionally draw the connecting anchor lines
    if (withBorders) {
        //alert("hello");
        ctx.beginPath();
        ctx.moveTo(imageX, imageY);
        ctx.lineTo(imageRight, imageY);
        ctx.lineTo(imageRight, imageBottom);
        ctx.lineTo(imageX, imageBottom);
        ctx.closePath();
        ctx.lineWidth = 4;

      // set line color
        ctx.strokeStyle = '#ff0000';
        ctx.stroke();




        ctx.beginPath();
        ctx.moveTo(imageX_1, imageY_1);
        ctx.lineTo(imageRight_1, imageY_1);
        ctx.lineTo(imageRight_1, imageBottom_1);
        ctx.lineTo(imageX_1, imageBottom_1);
        ctx.closePath();
        ctx.lineWidth = 4;

      // set line color
        ctx.strokeStyle = 'green';
        ctx.stroke();
    }

}

function drawDragAnchor(x, y) {
    ctx.beginPath();
    ctx.arc(x, y, resizerRadius, 0, pi2, false);
    ctx.closePath();
    ctx.fillStyle="red";
    ctx.fill();
}

function drawDragAnchor_1(x, y) {
    ctx.beginPath();
    ctx.arc(x, y, resizerRadius, 0, pi2, false);
    ctx.closePath();
    ctx.fillStyle="green";
    ctx.fill();
}

function anchorHitTest(x, y) {

    var dx, dy;

    // top-left
    dx = x - imageX;
    dy = y - imageY;
    if (dx * dx + dy * dy <= rr) {
        return (0);
    }
    // top-rightss
    dx = x - imageRight;
    dy = y - imageY;
    if (dx * dx + dy * dy <= rr) {
        return (1);
    }
    // bottom-right
    dx = x - imageRight;
    dy = y - imageBottom;
    if (dx * dx + dy * dy <= rr) {
        return (2);
    }
    // bottom-left
    dx = x - imageX;
    dy = y - imageBottom;
    if (dx * dx + dy * dy <= rr) {
        return (3);
    }
    return (-1);

}


function anchorHitTest_1(x, y) {

    var dx, dy;

    // top-left
    dx = x - imageX_1;
    dy = y - imageY_1;
    if (dx * dx + dy * dy <= rr) {
        return (0);
    }
    // top-rightss
    dx = x - imageRight_1;
    dy = y - imageY_1;
    if (dx * dx + dy * dy <= rr) {
        return (1);
    }
    // bottom-right
    dx = x - imageRight_1;
    dy = y - imageBottom_1;
    if (dx * dx + dy * dy <= rr) {
        return (2);
    }
    // bottom-left
    dx = x - imageX_1;
    dy = y - imageBottom_1;
    if (dx * dx + dy * dy <= rr) {
        return (3);
    }
    return (-1);

}



function hitImage(x, y) {
    return (x > imageX && x < imageX + imageWidth && y > imageY && y < imageY + imageHeight);
}

function hitImage_1(x, y) {
    return (x > imageX_1 && x < imageX_1 + imageWidth_1 && y > imageY_1 && y < imageY_1 + imageHeight_1);
}



function handleMouseDown(e) {
    startX = parseInt(e.clientX - offsetX);
    startY = parseInt(e.clientY - offsetY);
    draggingResizer = anchorHitTest(startX, startY);
    draggingImage = draggingResizer < 0 && hitImage(startX, startY);


    draggingResizer_1 = anchorHitTest_1(startX, startY);
    draggingImage_1 = draggingResizer_1 < 0 && hitImage_1(startX, startY);
}

function handleMouseUp(e) {
    draggingResizer = -1;
    draggingImage = false;

    draggingResizer_1 = -1;
    draggingImage_1 = false;

    draw(true, true);
}


function getdimensions()
{   
    var topleft=imageX;
    var topright=imageX+imageWidth;
    var bottomleft=imageY;
    var bottomright=imageY+imageHeight;
    var choice=$('input[name="red"]:checked').val();

    if (choice!=0 && choice!=1 && choice!=2 )
        choice=-1;
    //alert(choice);
    
    var topleft_1=imageX_1;
    var topright_1=imageX_1+imageWidth_1;
    var bottomleft_1=imageY_1;
    var bottomright_1=imageY_1+imageHeight_1;
    var choice_1=$('input[name="green"]:checked').val();

    //alert("top-left:"+topleft+",top-right:"+topright+",bottom-left:"+bottomleft+",bottom-right:"+bottomright+",Choice:"+choice);
    //$.post( "test.php", { name: "John", time: "2pm" } );

     if (choice_1!=0 && choice_1!=1 && choice_1!=2 )
        choice_1=-1;
    //alert(choice_1);
   

    str='img='+GetUrlValue('img')+'&tl_1='+topleft+'&tr_1='+topright+'&bl_1='+bottomleft+'&br_1='+bottomright+'&c_1='+choice+'&tl_2='+topleft_1+'&tr_2='+topright_1+'&bl_2='+bottomleft_1+'&br_2='+bottomright_1+'&c_2='+choice_1;
    
    window.location="test.php?"+str;
    
    //alert(str);

}

function handleMouseOut(e) {
    handleMouseUp(e);
}

function handleMouseMove(e) {

    if (draggingResizer > -1) {

        mouseX = parseInt(e.clientX - offsetX);
        mouseY = parseInt(e.clientY - offsetY);

        // resize the image
        switch (draggingResizer) {
            case 0:
                //top-left
                imageX = mouseX;
                imageWidth = imageRight - mouseX;
                imageY = mouseY;
                imageHeight = imageBottom - mouseY;
                break;
            case 1:
                //top-right
                imageY = mouseY;
                imageWidth = mouseX - imageX;
                imageHeight = imageBottom - mouseY;
                break;
            case 2:
                //bottom-right
                imageWidth = mouseX - imageX;
                imageHeight = mouseY - imageY;
                break;
            case 3:
                //bottom-left
                imageX = mouseX;
                imageWidth = imageRight - mouseX;
                imageHeight = mouseY - imageY;
                break;
        }

        if(imageWidth<25){imageWidth=25;}
        if(imageHeight<25){imageHeight=25;}

        // set the image right and bottom
        imageRight = imageX + imageWidth;
        imageBottom = imageY + imageHeight;

        // redraw the image with resizing anchors
        draw(true, true);

    } else if (draggingImage) {

        imageClick = false;

        mouseX = parseInt(e.clientX - offsetX);
        mouseY = parseInt(e.clientY - offsetY);

        // move the image by the amount of the latest drag
        var dx = mouseX - startX;
        var dy = mouseY - startY;
        imageX += dx;
        imageY += dy;
        imageRight += dx;
        imageBottom += dy;
        // reset the startXY for next time
        startX = mouseX;
        startY = mouseY;

        // redraw the image with border
        draw(false, true);

    }

    else if (draggingResizer_1 > -1) {

        mouseX = parseInt(e.clientX - offsetX);
        mouseY = parseInt(e.clientY - offsetY);

        // resize the image
        switch (draggingResizer_1) {
            case 0:
                //top-left
                imageX_1 = mouseX;
                imageWidth_1 = imageRight_1 - mouseX;
                imageY_1 = mouseY;
                imageHeight_1 = imageBottom_1 - mouseY;
                break;
            case 1:
                //top-right
                imageY_1 = mouseY;
                imageWidth_1 = mouseX - imageX_1;
                imageHeight_1 = imageBottom_1 - mouseY;
                break;
            case 2:
                //bottom-right
                imageWidth_1 = mouseX - imageX_1;
                imageHeight_1 = mouseY - imageY_1;
                break;
            case 3:
                //bottom-left
                imageX_1 = mouseX;
                imageWidth_1 = imageRight_1 - mouseX;
                imageHeight_1 = mouseY - imageY_1;
                break;
        }

        if(imageWidth_1<25){imageWidth_1=25;}
        if(imageHeight_1<25){imageHeight_1=25;}

        // set the image right and bottom
        imageRight_1 = imageX_1 + imageWidth_1;
        imageBottom_1 = imageY_1 + imageHeight_1;

        // redraw the image with resizing anchors
        draw(true, true);

    } else if (draggingImage_1) {

        imageClick_1 = false;

        mouseX = parseInt(e.clientX - offsetX);
        mouseY = parseInt(e.clientY - offsetY);

        // move the image by the amount of the latest drag
        var dx = mouseX - startX;
        var dy = mouseY - startY;
        imageX_1 += dx;
        imageY_1 += dy;
        imageRight_1 += dx;
        imageBottom_1 += dy;
        // reset the startXY for next time
        startX = mouseX;
        startY = mouseY;

        // redraw the image with border
        draw(false, true);

    }


}


$("#canvas").mousedown(function (e) {
    handleMouseDown(e);
});
$("#canvas").mousemove(function (e) {
    handleMouseMove(e);
});
$("#canvas").mouseup(function (e) {
    handleMouseUp(e);
});
$("#canvas").mouseout(function (e) {
    handleMouseOut(e);
});
</script>




</html>
