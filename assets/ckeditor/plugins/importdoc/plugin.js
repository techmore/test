CKEDITOR.plugins.add('importdoc',
{
    init: function (editor) {
        var pluginName = 'importdoc';
        editor.ui.addButton('importdoc',
            {
                label: 'Import from Word document',
                command: 'OpenWindow',
                icon: CKEDITOR.plugins.getPath('importdoc') + 'word.png',
                toolbar: 'import'
            });

        var cmd = editor.addCommand('OpenWindow', { exec: showMyDialog });
    }
});

function showMyDialog(editor) {

    $("#myForm").remove();

    //window.open('/Default.aspx', 'MyWindow', 'width=800,height=700,scrollbars=no,scrolling=no,location=no,toolbar=no');
    var formElement = document.createElement("form");
    formElement.setAttribute("id", "myForm");
    formElement.setAttribute("action", "../../report/importdoc");
    formElement.setAttribute("method", "post");
    formElement.setAttribute("enctype", "multipart/form-data");
    //formElement.setAttribute("style", "position:absolute; top:0;left:0; z-index:-1000;");


    var hiddenElement = document.createElement("input");
    hiddenElement.setAttribute('type', 'hidden');
    hiddenElement.setAttribute('id', 'ajax');
    hiddenElement.setAttribute('name', 'ajax');
    hiddenElement.setAttribute('value', '1');
    formElement.appendChild(hiddenElement);


    var element = document.createElement("input");
    element.setAttribute('type', 'file');
    element.setAttribute('id', 'userfile');
    element.setAttribute('name', 'userfile');
    element.setAttribute('value', 'userfile');
    element.setAttribute('accept', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-doc, .doc, .docx');
    formElement.appendChild(element);


    //if(element.attachEvent)
    $(element).bind('change', function(e){
        var options = {
            cache: false,
            complete: function(response){
                var responseStr = response.responseText;
                var finalStr = responseStr.replace("<title>PHPWord</title>","");
                //alert(finalStr);
                editor.insertHtml(finalStr);
            },
            error: function(){
                alert('Import failed! Check your connection and try again.');
            }
        };

        $("#myForm").ajaxForm(options);

        $("#myForm").submit();


        formElement.removeChild(element);
        document.body.removeChild(formElement);
    });


    document.body.appendChild(formElement);

    element.click();

}