n =  new Date();
y = n.getFullYear();
m = n.getMonth() + 1;
if(m<10) m = '0'+m;
d = n.getDate();
if(d<10) d = '0'+d;

document.getElementById("currentDate").value = y + "-" + m + "-" + d;

