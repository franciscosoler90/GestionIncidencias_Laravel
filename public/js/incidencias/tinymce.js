tinymce.init({
    // Selector del elemento HTML en el que se inicializará TinyMCE
    selector: 'textarea',

    // Habilita los comentarios incrustados
    tinycomments_mode: 'embedded',

    // Define el autor predeterminado de los comentarios
    tinycomments_author: 'ACK',

    // Establece el idioma de TinyMCE a español (España)
    language: 'es',

    // Altura del editor en píxeles
    height: 240,

    // Permite redimensionar el editor
    resize: true,

    // Muestra la barra de estado en la parte inferior del editor
    statusbar: true,

    // Desactiva la ruta de elementos en la barra de estado
    elementpath: false,

    // Botones de la barra de herramientas disponibles
    toolbar: 'newdocument | bold | numlist bullist | image',

    // Plugins habilitados (en este caso, solo el plugin de listas e imagen)
    plugins: 'lists, image',

    // Desactiva la barra de menú superior
    menubar: false,

    // Modo en línea desactivado (TinyMCE se muestra en un bloque, no en línea)
    inline: false,


    image_title: true,
    /* enable automatic uploads of images represented by blob or data URIs*/
    automatic_uploads: true,
    /*
      URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
      images_upload_url: 'postAcceptor.php',
      here we add custom filepicker only to Image dialog
    */
    file_picker_types: 'image',
    /* and here's our custom image picker*/
    file_picker_callback: (cb, value, meta) => {
      const input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.setAttribute('accept', 'image/*');
  
      input.addEventListener('change', (e) => {
        const file = e.target.files[0];
  
        const reader = new FileReader();
        reader.addEventListener('load', () => {
          /*
            Note: Now we need to register the blob in TinyMCEs image blob
            registry. In the next release this part hopefully won't be
            necessary, as we are looking to handle it internally.
          */
          const id = 'blobid' + (new Date()).getTime();
          const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
          const base64 = reader.result.split(',')[1];
          const blobInfo = blobCache.create(id, file, base64);
          blobCache.add(blobInfo);
  
          /* call the callback and populate the Title field with the file name */
          cb(blobInfo.blobUri(), { title: file.name });
        });
        reader.readAsDataURL(file);
      });
  
      input.click();
    },
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
});