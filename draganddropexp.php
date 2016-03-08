
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
        <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
   
        
        
            <style>
                
                .draggable {
                    background-color: blue;
                    height: 50px;
                    width: 200px;
                   /* position: absolute; */
                    
                    }
                
                
            </style>
        
        
        
         </head>
    <body>

        






        <script>

            $(document).ready(function () {

                /*         */

                var draggableDiv = document.createElement("div");
                draggableDiv.classList.add('draggable');
                document.body.appendChild(draggableDiv);

                var draggableDiv2 = document.createElement("div");
                draggableDiv2.classList.add('draggable');
                document.body.appendChild(draggableDiv2);


                /*         */



                var clickX = null;
                var clickY = null;

                var elementBeingDragged = null;

                $('.draggable').mousedown(function (event) {
                    $(this).css('position', 'absolute');
                    var parentOffset = $(this).offset();
                    clickX = event.pageX - parentOffset.left;
                    clickY = event.pageY - parentOffset.top;
                    elementBeingDragged = $(this);
                });

                $('.draggable').mouseup(function (event) {
                    //  $(elementBeingDragged).css('position', 'static');
                    elementBeingDragged = null;

                });


                $('.html').mouseup(function (event) {

                    elementBeingDragged = null;
                });


                $('html').mousemove(function (event) {
                    if (elementBeingDragged != null) {
                        $(elementBeingDragged).css({ top: event.pageY - clickY,
                            left: event.pageX - clickX
                        });
                    }
                });

                $('.draggable').mousemove(function (event) {
                    if (event.which == true) {
                        $(elementBeingDragged).css({ top: event.pageY - clickY,
                            left: event.pageX - clickX
                        });
                    }
                    event.stopPropagation();
                });

            });

        </script>


        
    </body>
</html>