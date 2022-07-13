var base = location.protocol + "//" + location.host;
var route = document.getElementsByName("routeName")[0].getAttribute("content");

document.addEventListener("DOMContentLoaded", function () {
    var btn_buscar = document.getElementById("btn_buscar");
    var form_search = document.getElementById("form_search");
    if (btn_buscar) {
        btn_buscar.addEventListener("click", function (e) {
            e.preventDefault();
            if (form_search.style.display === "block") {
                form_search.style.display = "none";
            } else {
                form_search.style.display = "block";
            }
        });
    }
    if (route == "producto_editar") {
        var btn_producto_file_imagen = document.getElementById(
            "btn_producto_file_imagen"
        );
        var producto_file_imagen = document.getElementById(
            "producto_file_imagen"
        );
        btn_producto_file_imagen.addEventListener(
            "click",
            function () {
                producto_file_imagen.click();
            },
            false
        );
        producto_file_imagen.addEventListener("change", function () {
            document.getElementById("form_producto_galeria").submit();
        });
    }
    route_active = document
        .getElementsByClassName("lk-" + route)[0]
        .classList.add("active");

    btn_eliminar = document.getElementsByClassName("btn-eliminar");
    for (i = 0; i < btn_eliminar.length; i++) {
        btn_eliminar[i].addEventListener("click", delete_object);
    }
});

$(document).ready(function () {
    editor_init("editor");
});

function editor_init(field) {
    CKEDITOR.replace(field, {
        toolbar: [
            {
                name: "clipboard",
                items: [
                    "Cut",
                    "Copy",
                    "Paste",
                    "PasteText",
                    "-",
                    "Undo",
                    "Redo",
                ],
            },
            {
                name: "basicstyles",
                items: [
                    "Bold",
                    "Italic",
                    "BulletedList",
                    "Strike",
                    "Image",
                    "Link",
                    "Blockquote",
                ],
            },
            {
                name: "document",
                items: ["CodeSnippet", "EmojiPanel", "Preview", "Source"],
            },
        ],
    });
}

function delete_object(e) {
    e.preventDefault();
    var object = this.getAttribute("data-object");
    var action = this.getAttribute("data-action");
    var path = this.getAttribute("data-path");
    var url = base + '/' + path + '/' + object + '/'+ action;
    var title, text, icon;
    //console.log(object, path, url);
    if(action == "eliminar"){
        title = "¿Esta seguro de eliminar este producto?";
        text = "Recuerda que esta acción enviara este elemento a la papelera o lo eliminara de forma definitiva.";
        icon = "warning";
    }
    if(action == "restaurar"){
        title = "¿Quiere restaurar este elemento?";
        text = "Esta acción restaurará este elemento y estará activo en la base de datos.";
        icon = "info";
    }
    swal({
        title: title,
        text: text,
        icon: icon,
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            window.location.href = url;
        }
    });
}
