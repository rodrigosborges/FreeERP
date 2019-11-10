var currentTab = 0; 
showTab(currentTab); 
    
function showTab(n) {
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    
    if (n == 0) {
        document.getElementById("prevBtn").disabled = true;
    } else {
        document.getElementById("prevBtn").disabled = false;
    }

    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").disabled = true;
        $('#submit-btn').removeClass('invisible')
    } else {
        document.getElementById("nextBtn").disabled = false;
        $('#submit-btn').addClass('invisible')
    }
}

function nextPrev(n) {
    var x = document.getElementsByClassName("tab");
    
    x[currentTab].style.display = "none";
    
    currentTab = currentTab + n;
    
    if (currentTab >= x.length) {
        
    document.getElementById("regForm").submit();
        return false;
    }
    
    showTab(currentTab);
}

