$(document).ready(function () {


    // $(document).on('click', '.plus', function (e) {
    //     var setting = $(this).parents('.setting'),
    //         clone = setting.clone();
    //     console.log(setting);
    //     setting.after(clone);
    // });

    $(document).on("click", "#add-setting", function (e) {
        var name = $('input[name=setting-input]'),
            value = $('textarea[name=setting-textarea]'),
            settingItem = $('.setting-item').last();
        var newItem = settingItem.clone();
        if (name.val() !== '' && value.val() !== '') {
            newItem.find('label').text(name.val());
            newItem.find('textarea').val(value.val());
        } else {
            var numberOption = $('select[name=setting-dropdown-list]').find('option:selected').val(),
                option = $("#option-settings-value").find('li.id-' + numberOption);
            newItem.find('label').text(option.find('span.name').text());
            newItem.find('label').text(option.find('span.value').text());
        }
        settingItem.before(newItem);
        $('#setting').modal('hide');
    })
});
