function expend(nr)
{
    let field = document.getElementById("setting"+nr);

    if (field.style.display === 'none') {
        field.style.display = 'table-row';
    } else {
        field.style.display = 'none';
    }
}