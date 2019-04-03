function addItem(e, item)
{
    let addItemTeamplate = $('#item_possible_value').html();
    $(item).parents('#possible_values').append(addItemTeamplate);
}

function deleteItem(e, item)
{
    console.log(item);
    $(item).parents('.item').remove();
}

function selectType(element)
{
    if(element.value == 2 || element.value == 3){
        $('#possible_values').css('display', 'block');
    }else{
        $('#possible_values').css('display', 'none');
    }
}

$(document).ready(function() {

    $('#possible_values').on('click', '.add_item', function(e){
        addItem(e, this);
    });

    $('#possible_values').on('click', '.delete_item', function(e){
        deleteItem(e, this);
    });
});
