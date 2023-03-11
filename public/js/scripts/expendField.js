function expendField(nr)
{
    let rowsToHide = document.getElementsByClassName('userField');
    for (let i = 0; i < rowsToHide.length; i++) {
        rowsToHide[i].style.display = 'none';
    }

    let field = document.getElementById('setting'+nr);

    if (field.style.display === 'none') {
        field.style.display = 'table-row';
    } else {
        field.style.display = 'none';
    }
}