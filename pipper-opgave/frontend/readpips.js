// LÆS PIP FRA DB 

// Først skal vi hente vores json-fil fra DB
async function readPip() {
    const result = await fetch("http://localhost:8000");
    const pipFromDB = await result.json();

    // Så henter vi hvert element fra vores objekt
    const items = [];
        for(pip in pipFromDB){
        items.push(pipFromDB[pip]);
        }

    // Vi looper hen over hvert array i DB
    pipFromDB.forEach(function (pip) {

        // Opret en div hvori du indsætter dine pip-værdier
        // Vores objekt ser sådan ud:

        /* 
            {
               "pipID": "1",
               "username": "denitsa1234",
               "pipmessage": "Hello World!",
               "datetime": "2022-09-09 10:15:36"
            },
        */    

        // 
        const element = 
        `
        <div class ="pip-boks">
        <div class="bruger">
            <div class="avatar"><img src="https://xsgames.co/randomusers/avatar.php?g=pixel"
                    alt="billede" id="billede_avatar"></div>

            <div class="brugernavn">
                <h3 id="person">@${pip.username}</h3>
            </div>
        </div>
        
        <div class="pipBesked">
            <p>${pip.pipmessage}</p>
        </div>
        </div>`

    //Så skal vi tilføje elementet i vores HTML, det gør vi med querySelector.
    //Inde i gåseøjenene skriver vi navnet på den container vi har lavet i vores html 

    const div = document.querySelector(".container");
    div.innerHTML += element;
    });
}

readPip();



