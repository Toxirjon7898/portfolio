<?php
echo "Salom";
?>
<!DOCTYPE html>
<html lang="uz">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foydalanuvchi qo'shish</title>
    <link rel="stylesheet" href="style.css"> 
  </head>
  <body>
    <h1>Foydalanuvchi qo'shish!</h1>
    <form id="userForm">
      <input type="text" id="nameInput" placeholder="Ismingizni" required>
      <input type="email" id="emailInput" placeholder="Email" required>
    <button type="submit">Qo'shish</button>
    </form>
    <div id="natija"></div>
    <script>
      const forma = document.querySelector("#userForm");
const nameInput = document.querySelector("#nameInput");
const emailInput = document.querySelector("#emailInput");
const natija = document.querySelector("#natija");

forma.addEventListener("submit", async (event) => {
  event.preventDefault();
  const ism = nameInput.value.trim();
  const email = emailInput.value.trim();

  if (ism === "" || email === ""){
    natija.textContent = "Barcha maydonlarni to'ldiring";
    natija.style.color = "red";
    return;
  }
  natija.textContent = "Yuklanmoqda...";
  natija.style.color = "black";
  try{
    const response = await fetch("https://jsonplaceholder.typicode.com/users",{
      method: "POST",
      headers: {
        "Content-Type" : "application/json"
      },
      body: JSON.stringify({name: ism, email: email})
    });
    if (!response.ok){
      throw new Error(`HTTP xato: ${response.status}`);
    }
    const data = await response.json();
    natija.textContent = `Qo'shildi! ID: ${data.id}`;
    natija.style.color = "green";
    forma.reset();
     
  }catch(error){
    natija.textContent = `Xato: ${error.message}`;
    natija.style.color = "red";
  }
});
    </script>
  </body>
</html>
