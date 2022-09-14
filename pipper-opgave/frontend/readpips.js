/*
async function callApi() {​
    let result = await fetch('http://localhost:8000');​
    result = await result.json();​
    console.log(result);​
}​

callApi();
*/

function whenUserSubmitPip() {
    const user = document.getElementById("username").value
    const pip = document.getElementById("pip").value

    fetch("http://localhost:8000", {
        method: "POST",

    })

}

async function test() {
    const result = await fetch("http://localhost:8000");
    console.log(result);
    const body = await result.json();
    console.log(body)
    // [ {}, {}, {} ]
    body.forEach(function (pip) {
        console.log(pip);
    });
}

test();

