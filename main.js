
document.addEventListener('DOMContentLoaded', function () {
    // your code using querySelectorAll here

    // Select all form inputs and buttons
    const formInputs = document.querySelectorAll("input");
    const buttons = document.querySelectorAll("button");

    // Change background color to yellow when input is selected
    formInputs.forEach((input) => {
        input.addEventListener("focus", () => {
            input.style.backgroundColor = "yellow";
        });
    });

    // Change background color to white when user leaves input field
    formInputs.forEach((input) => {
        input.addEventListener("blur", () => {
            input.style.backgroundColor = "white";
        });
    });

    // Change background color to light blue when mouse hovers over a button
    buttons.forEach((button) => {
        button.addEventListener("mouseover", () => {
            button.style.backgroundColor = "lightblue";
        });

        // Change background color back to default when mouse leaves the button
        button.addEventListener("mouseout", () => {
            button.style.backgroundColor = "";
        });
    });
});
