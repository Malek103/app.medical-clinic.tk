const array1 = new Array('08:00 - 08:15','08:15 - 08:30','08:30 - 08:45','08:45 - 09:00','09:00 - 09:15','09:15 - 09:30','09:30 - 09:45','09:45 - 10:00','10:00 - 10:15','10:15 - 10:30','10:30 - 10:45','10:45 - 11:00','11:00 - 11:15','11:15 - 11:30','11:30 - 11:45','11:45 - 12:00','12:00 - 12:15','12:15 - 12:30','12:30 - 12:45','12:45 - 13:00','13:00 - 13:15','13:15 - 13:30','13:30 - 13:45','13:45 - 14:00','14:00 - 14:15','14:15 - 14:30','14:30 - 14:45','14:45 - 15:00','15:00 - 15:15','15:15 - 15:30','15:30 - 15:45','15:45 - 16:00','16:00 - 16:15','16:15 - 16:30','16:30 - 16:45','16:45 - 17:00','17:00 - 17:15','17:15 - 17:30','17:30 - 17:45','17:45 - 18:00','18:00 - 18:15','18:15 - 18:30','18:30 - 18:45','18:45 - 19:00');
function loopSelect (resArray){
    let select=document.getElementById("work_time");
    select.innerHTML = null
    for(let i=0;i<resArray.length;i++){
        let option=document.createElement("OPTION");
        txt=document.createTextNode(resArray[i]);
        option.appendChild(txt);
        select.insertBefore(option,select.lastChild);
    }
}
function editSelect(data){
    const array2 = data.map((value)=>value['time']);
    console.log(array2.length)
    if (array2.length > 0) {
        console.log(array2,'array have more than ')
        return array1.filter(item => !array2.includes(item))
    }
    return array1
}
function myFunction(){

    const date=document.querySelector('#date').value;

    var headers = {
        "Contect-Type": "application/json",
    };
    $.ajax({
        headers: headers,
        type: "GET",
        url: "/reservations/gettime/"+date,

        dataType: 'json',

        success: function (data) {
            const resArray = editSelect(data)
            loopSelect(resArray)

        },
        dataType: "json",
        error: function (error) {
            const resArray = editSelect([])
            loopSelect(resArray)
        }
    })
}
