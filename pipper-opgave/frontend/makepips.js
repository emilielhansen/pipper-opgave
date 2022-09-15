function whenUserSubmitPip() {
    const user = document.getElementById("username").value
    const pip = document.getElementById("pip").value

    const asObject = {
        username: user,
        pipbesked: pip,
    }

    fetch("http://localhost:8000", {
        method: "POST",
    body: JSON.stringify(asObject)
})
}
