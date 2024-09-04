CKEDITOR.plugins.add('delete',
{
    init: function (editor) {

        var canRemove = editor.element.getAttribute('canRemove');

        if(canRemove == "yes") {

            var pluginName = 'delete';
            editor.ui.addButton('delete',
                {
                    label: 'Remove Objective',
                    command: 'deleteObjective',
                    icon: CKEDITOR.plugins.getPath('delete') + 'delete.png',
                    toolbar: 'manipulate'
                });

            var cmd = editor.addCommand('deleteObjective', {exec: deleteDialog});

        }

    }
});

function deleteDialog(editor) {
    var step    =   editor.element.getAttribute('step');
    var confirmMessage = "";

    if(step=="3/3" || step == "5/2"){
        confirmMessage = "This will permanently delete the objective and corresponding function. Do you want to continue?";
    }else if(step == "3/4" || step=="5/3"){
        confirmMessage = "This will permanently delete the objective. Do you want to continue?";
    }

    if(confirm(confirmMessage)){

        var itemId = editor.element.getAttribute('data-id');
        var index = editor.element.getAttribute('item-index');
        var entType = editor.element.getAttribute('ent-type');
        var objRow = document.getElementById("objRow"+entType+index);
        if(step=="3/3" || step == "5/2") {
            var functionRow = document.getElementById("functionRow" + entType + index);
        }

        var formData = {
            ajax: 1,
            entityId: itemId,
            randomNumber: Math.random()
        };

        $.ajax({
            url: '../../plan/removeObjective',
            data: formData,
            type: 'POST',
            success: function (response) {
                if(response == 'deleted'){
                    objRow.parentNode.removeChild(objRow);
                    if(step=="3/3" || step == "5/2") {
                        functionRow.parentNode.removeChild(functionRow);
                    }
                }
                //alert(response);
            }

        });

    }
}