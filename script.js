function getPrice() {
    const mealName = document.getElementById("mealName").value.trim();
    const result = document.getElementById("priceResult");

    if (mealName === "") {
        result.textContent = "⚠️ الرجاء إدخال اسم الوجبة";
        return;
    }

    fetch("../getPrice.php?meal=" + encodeURIComponent(mealName))
        .then(response => response.text())
        .then(data => {
            console.log(data);
            result.textContent = "السعر: " + data;
        })
        .catch(() => {
            result.textContent = "حدث خطأ، حاول مرة أخرى";
        });
}