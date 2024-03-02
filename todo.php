<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 93vh;
    background-color: #ccc;
    width: 100%;
}

.goback{
    padding: 10px 30px;
    margin-top: 30px;
    color: white;
    border: none;
    border-radius: 4px;
    color: #333;
    cursor: pointer;
    transition: background-color 0.3s;
}

.container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 400px;

}

h2 {
    margin-top: 0;
    font-size: 24px;
    text-align: center;
    color: #333;
}

.input-container {
    display: flex;
    margin-bottom: 10px;
}

.input-container input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    outline: none;
}

.input-container button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    margin-left: 10px;
}

.btn-container {
    margin-bottom: 10px;
    text-align: center;
    display: flex;
    margin-left: 10px;
    column-gap: 5px;

}

.btn-container button {
    padding: 10px 10px;
    font-size: 16px;
    margin-right: 5px;
    background-color: #008CBA;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-container button:hover {
    background-color: #005f7f;
}

#taskList {
    list-style-type: none;
    padding: 0;
}

#taskList li {
    margin-bottom: 10px;
    display: flex;
    align-items: center;
}

#taskList li span {
    margin-left: 10px;
    font-size: 16px;
    color: #333;
}

#taskList li input[type="checkbox"] {
    margin-right: 10px;
}

#taskList li input[type="checkbox"]:checked + span {
    text-decoration: line-through;
    color: #888;
}


/* mobile */
@media screen and (max-width: 768px) {
    .container {
        width: 70%; /* ปรับความกว้างให้เต็มหน้าจอของมือถือ */
        max-width: none; /* ไม่กำหนดความกว้างสูงสุด */
    }

    .input-container input {
        width: 100%;
        font-size: 14px;
    }

    .btn-container{
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        row-gap: 10px;
        margin-left: 0px;
    }
    .btn-container button{
        width: 70%;
        height: auto;
    }

}
    </style>
</head>
<body>

<div class="container">
    
    <h2>Todo List</h2>
    <div class="input-container">
        <input type="text" id="taskInput" placeholder="Enter task...">
        <button onclick="addTask()">Add</button>
    </div>
    <div class="btn-container">
        <button onclick="showCompleted()">Completed Tasks</button>
        <button onclick="showPending()">Pending Tasks</button>
        <button onclick="clearAll()">Clear All</button>
    </div>
    <ul id="taskList"></ul>
</div>
<button class="goback">back</button>
<script>

document.querySelector(".goback").addEventListener("click", function() {
            window.location.href = "index.php";
        });

    // JavaScript สำหรับการเพิ่ม, แสดง, แก้ไข และลบงานในรายการ
    let tasks = [];

    // ตรวจสอบค่าที่เก็บไว้ใน localStorage เมื่อหน้าเว็บโหลด
    window.onload = function() {
        const savedTasks = JSON.parse(localStorage.getItem('tasks'));
        if (savedTasks) {
            tasks = savedTasks;
            showTasks();
        }
    };

    function addTask() {
        const taskInput = document.getElementById("taskInput");
        const taskName = taskInput.value.trim();
        if (taskName !== "") {
            tasks.push({ name: taskName, completed: false });
            taskInput.value = "";
            showTasks();
            // บันทึกข้อมูลใหม่ลงใน localStorage เมื่อเพิ่มงาน
            localStorage.setItem('tasks', JSON.stringify(tasks));
        }
    }

    function showTasks(filterCompleted = false) {
        const taskList = document.getElementById("taskList");
        taskList.innerHTML = "";
        tasks.forEach((task, index) => {
            if (filterCompleted && !task.completed) return;
            if (!filterCompleted && task.completed) return;
            const listItem = document.createElement("li");
            const checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.checked = task.completed;
            checkbox.addEventListener("change", () => {
                tasks[index].completed = checkbox.checked;
                showTasks(filterCompleted);
                // บันทึกการเปลี่ยนแปลงลงใน localStorage เมื่อมีการเลือก checkbox
                localStorage.setItem('tasks', JSON.stringify(tasks));
            });
            const taskName = document.createElement("span");
            taskName.textContent = task.name;
            if (task.completed) {
                taskName.style.textDecoration = "line-through";
            }
            listItem.appendChild(checkbox);
            listItem.appendChild(taskName);
            taskList.appendChild(listItem);
        });
    }

    function showCompleted() {
        showTasks(true);
    }

    function showPending() {
        showTasks(false);
    }

    function clearAll() {
        tasks = [];
        showTasks();
        // ลบข้อมูลทั้งหมดออกจาก localStorage เมื่อกดปุ่ม "Clear All"
        localStorage.removeItem('tasks');
    }

</script>

</body>
</html>
