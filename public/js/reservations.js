    //add examinations
    const addexam = document.querySelector('.addExam');
    const btn = document.querySelector('.addbtn');
    btn.addEventListener('click', () => {
    addexam.style.display = null
})

    function addexamination() {
    let name = document.getElementById('exam_name').value

    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},

    type: "POST",
    url: " http://app.medical-clinic.tk/examinations/create",
    data: {
    "name": name,
},
    // success: success,
    success: function (data) {
    console.log("success");
    getExamination();
    alert(data[1]);

},
    dataType: "json",
    error: function (error) {
    console.log("error");
    getExamination();
    console.log(JSON.stringify(error));
}
});
    addexam.style.display = "none";

    function getExamination() {
    var headers = {
    "Contect-Type": "application/json",
    // "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI2IiwianRpIjoiZmE1Yzk2YTU0NGFlMjViZmZlY2ZmYmEyNmYyN2RiM2NhNzc4NzY5YWNjZWJiZGFlODIxNzUzM2IwMzY1NDdmMWMyYTM3MTRiMDdiMjlhM2YiLCJpYXQiOjE2NTU2MTcxNTkuNTMzMjYyOTY4MDYzMzU0NDkyMTg3NSwibmJmIjoxNjU1NjE3MTU5LjUzMzI2OTg4MjIwMjE0ODQzNzUsImV4cCI6MTY4NzE1MzE1OS41MjE0MjMxMDE0MjUxNzA4OTg0Mzc1LCJzdWIiOiIyOCIsInNjb3BlcyI6W119.A0OzFZbsqK3gDOhn-gfnC61TY56Iab671bADtIbqngrEfVvT90IAQieQtPKoBWnldOixIvFDZwJVSYyY4SCk2YV2kPb2X5TqbEOHRAUu5hMXDDZAG96b-aXtd5S1Bg_UdAH2NOQl67yljgBdBnZKvqeXBUHwTZ-pGgF0nV9oCExPoeZqhFKfvHf-pPowzpWcowxkS8H_K5b7ewb2sJNwg3k1svOxJUlTWkhgs8FCD2k_eOwLUniLyK80psKsuj7zO5iyrTeJIDBGbBBcqRL9TeKu-1FWg5W7FjGz8g9LE1cQrN9iXwwGuXIBjD0IEpEtDEr81MLjLeVp2wYr9wZOevagKknbwUCLfr24lTFhCQZ-6mTt2llvMP0isnwGzFEdXskMoFDPyiARRD1F3GfvxcjmwdOva9_EppryDy6EMCqT2fNjO1vTdiGi_d6yBQR9BJw-7fRFuDebd54oQJnu8NQvycO6SQJDJbilLXAjFy7wq5r6vlp-yXAedtJJ9lkJwOJiFmyDvd3e-uKRVtm76IC5IdixSyFEBJ33ZxbKdZB5QAPj1feClZ8r8fT55j-RvrDjwb97yVprYLH5JWXqheuNvja_lhSQQZHWSzNxf7BSG-6qqDlCwcc7VrDeZffnE9RX9viFNQootx57Bx0inQ2YrpVNSFIqRPkyvbnsRYQ"
};

    $.ajax({
    headers: headers,
    type: "GET",
    url: "http://app.medical-clinic.tk/examinations/getexamination",

    dataType: 'json',
    // success: success,
    success: function (data) {
    $('#examination_id').find('option').remove().end().append('<option value="0">إختيار الفحص</option>').val('0');
    $.each(data, function (index, value) {
    // alert(value.name)
    $("#examination_id").append(new Option(value.name, value.id));

});
    // console.log(['data']);

    console.log(headers);
},
    dataType: "json",
    error: function (error) {

}
})



}


}

// add xray
    const xraybtn = document.querySelector('.addxray');
    const add_xray = document.querySelector('.addXray');
    xraybtn.addEventListener('click', () => {
    add_xray.style.display = null
})

    function xtrayAdd() {
    let name = document.getElementById('xray_name').value

    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},

    type: "POST",
    url: "http://app.medical-clinic.tk/xrays/create",
    data: {
    "name": name,
},
    // success: success,
    success: function (data) {
    alert(data[1]);
},
    dataType: "json",
    error: function (error) {
    getExray();
    console.log(JSON.stringify(error));

}
});
    add_xray.style.display = "none";
    function getExray(){
    var headers = {
    "Contect-Type": "application/json",
};

    $.ajax({
    headers: headers,
    type: "GET",
    url: "http://app.medical-clinic.tk/xrays/getxrays",

    dataType: 'json',
    // success: success,
    success: function (data) {
    // $('#examination_id').find('option').remove().end().append('<option value="0">إختيار صورة الاشعة</option>').val('0');
    $.each(data, function (index, value) {
    // alert(value.name)
    $("#xray_id").append(new Option(value.name, value.id));

});
    // console.log(['data']);

    console.log(headers);
},
    dataType: "json",
    error: function (error) {

}
})
}
}
//add medicies

    const mediciesbtn = document.querySelector('.addmedicines');
    const add_mediciens = document.querySelector('.addMedicines');
    mediciesbtn.addEventListener('click', () => {
    add_mediciens.style.display = null;
})

    function mediciesAdd() {
    let name = document.getElementById('medicine_name').value

    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},

    type: "POST",
    url: "http://app.medical-clinic.tk/medicines/create",
    data: {
    "name": name,
},
    // success: success,
    success: function (data) {
    alert(data[1]);
},
    dataType: "json",
    error: function (error) {
    getmedicies();
    console.log(JSON.stringify(error));
}
});
    add_mediciens.style.display = "none";
    function getmedicies(){
    var headers = {
    "Contect-Type": "application/json",
    // "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI2IiwianRpIjoiZmE1Yzk2YTU0NGFlMjViZmZlY2ZmYmEyNmYyN2RiM2NhNzc4NzY5YWNjZWJiZGFlODIxNzUzM2IwMzY1NDdmMWMyYTM3MTRiMDdiMjlhM2YiLCJpYXQiOjE2NTU2MTcxNTkuNTMzMjYyOTY4MDYzMzU0NDkyMTg3NSwibmJmIjoxNjU1NjE3MTU5LjUzMzI2OTg4MjIwMjE0ODQzNzUsImV4cCI6MTY4NzE1MzE1OS41MjE0MjMxMDE0MjUxNzA4OTg0Mzc1LCJzdWIiOiIyOCIsInNjb3BlcyI6W119.A0OzFZbsqK3gDOhn-gfnC61TY56Iab671bADtIbqngrEfVvT90IAQieQtPKoBWnldOixIvFDZwJVSYyY4SCk2YV2kPb2X5TqbEOHRAUu5hMXDDZAG96b-aXtd5S1Bg_UdAH2NOQl67yljgBdBnZKvqeXBUHwTZ-pGgF0nV9oCExPoeZqhFKfvHf-pPowzpWcowxkS8H_K5b7ewb2sJNwg3k1svOxJUlTWkhgs8FCD2k_eOwLUniLyK80psKsuj7zO5iyrTeJIDBGbBBcqRL9TeKu-1FWg5W7FjGz8g9LE1cQrN9iXwwGuXIBjD0IEpEtDEr81MLjLeVp2wYr9wZOevagKknbwUCLfr24lTFhCQZ-6mTt2llvMP0isnwGzFEdXskMoFDPyiARRD1F3GfvxcjmwdOva9_EppryDy6EMCqT2fNjO1vTdiGi_d6yBQR9BJw-7fRFuDebd54oQJnu8NQvycO6SQJDJbilLXAjFy7wq5r6vlp-yXAedtJJ9lkJwOJiFmyDvd3e-uKRVtm76IC5IdixSyFEBJ33ZxbKdZB5QAPj1feClZ8r8fT55j-RvrDjwb97yVprYLH5JWXqheuNvja_lhSQQZHWSzNxf7BSG-6qqDlCwcc7VrDeZffnE9RX9viFNQootx57Bx0inQ2YrpVNSFIqRPkyvbnsRYQ"
};

    $.ajax({
    headers: headers,
    type: "GET",
    url: "http://app.medical-clinic.tk/medicines/getmedicines",

    dataType: 'json',
    // success: success,
    success: function (data) {
    // $('#examination_id').find('option').remove().end().append('<option value="0">إختيار الفحص</option>').val('0');
    $.each(data, function (index, value) {
    // alert(value.name)
    $("#medicine_id").append(new Option(value.name, value.id));

});
    // console.log(['data']);

    console.log(headers);
},
    dataType: "json",
    error: function (error) {

}
})
}
}
