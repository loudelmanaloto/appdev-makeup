const base_url = "http://localhost/backend";
let selectedItemRecno = 0;


async function getStudents() {
  let request_url = `${base_url}/getstudents/`;
  try {
    const response = await fetch(request_url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }

    const json = await response.json();
    renderStudentsTable(json);
  } catch (error) {
    console.error(error.message);
  }
}




function renderStudentsTable(data) {
  let table = document.getElementById("students-table");
  table.innerHTML = "";
  data.forEach((item, index) => {
    let row = document.createElement("tr");
    let numberData = document.createElement("td");
    numberData.innerText = index + 1;
    let studentIdData = document.createElement("td");
    studentIdData.innerText = item.studentid;
    let fullnameData = document.createElement("td");
    fullnameData.innerText = item.fullname;

    let deleteButton = document.createElement('button')
    deleteButton.innerText = "Delete"

    deleteButton.addEventListener('click', ()=>{
      deleteStudent(item)
    })

    row.appendChild(numberData);
    row.appendChild(studentIdData);
    row.appendChild(fullnameData);
    row.appendChild(deleteButton)

    row.addEventListener('click', function onClick(){ 
      const form = document.getElementById('editstudent')
      form.studentid.value = item.studentid,
      form.fullname.value = item.fullname
      selectedItemRecno = item.recno
    })

    table.appendChild(row);
  });
}

async function addStudent(event) {
  event.preventDefault();
  let body = {
    studentid: event.target.studentid.value,
    fullname: event.target.fullname.value,
  };

  let request_url = `${base_url}/addstudent/`;
  try {
    const response = await fetch(request_url, {
      method: "POST",
      body: JSON.stringify(body),
    });
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }   

    const json = await response.json();
    getStudents();

  } catch (error) {
    console.error(error.message);
  }
}

async function editStudent(event) {
  event.preventDefault();
  let body = {
    studentid: event.target.studentid.value,
    fullname: event.target.fullname.value,
    recno: selectedItemRecno
  };

  let request_url = `${base_url}/editstudent/`;
  try {
    const response = await fetch(request_url, {
      method: "POST",
      body: JSON.stringify(body),
    });
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }   

    const json = await response.json();
    getStudents();

  } catch (error) {
    console.error(error.message);
  }
}

async function deleteStudent(item) {
  
  let body = {
    recno: item.recno
  };

  let request_url = `${base_url}/deletestudent/`;
  try {
    const response = await fetch(request_url, {
      method: "POST",
      body: JSON.stringify(body),
    });
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }   

    const json = await response.json();
    getStudents();

  } catch (error) {
    console.error(error.message);
  }
}

