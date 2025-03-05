<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Management</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .header h1 {
            margin: 0;
            font-size: 2.5rem;
        }
        .portfolio-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .portfolio-item {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .portfolio-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .portfolio-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .portfolio-item-content {
            padding: 15px;
        }
        .portfolio-item h3 {
            margin: 0;
            color: #2c3e50;
            font-size: 1.25rem;
        }
        .portfolio-item p {
            color: #7f8c8d;
            font-size: 14px;
            margin: 10px 0;
        }
        .portfolio-item .tech-used {
            color: #3498db;
            font-size: 12px;
            font-weight: bold;
        }
        .portfolio-item-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        .portfolio-item-actions button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .portfolio-item-actions .edit-btn {
            background-color: #3498db;
            color: white;
        }
        .portfolio-item-actions .edit-btn:hover {
            background-color: #2980b9;
        }
        .portfolio-item-actions .delete-btn {
            background-color: #e74c3c;
            color: white;
        }
        .portfolio-item-actions .delete-btn:hover {
            background-color: #c0392b;
        }
        .add-portfolio-btn {
            background-color: #2ecc71;
            border: none;
            padding: 10px 15px;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            margin: 20px;
            transition: background 0.3s;
        }
        .add-portfolio-btn:hover {
            background-color: #27ae60;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .modal-content h2 {
            margin-top: 0;
            color: #2c3e50;
        }
        .modal-content input,
        .modal-content textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .modal-content button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .modal-content .save-btn {
            background-color: #3498db;
            color: white;
        }
        .modal-content .save-btn:hover {
            background-color: #2980b9;
        }
        .modal-content .cancel-btn {
            background-color: #e74c3c;
            color: white;
        }
        .modal-content .cancel-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Portfolio Management</h1>
    </div>
    <button class="add-portfolio-btn" onclick="openModal()">+ Add New Portfolio Item</button>
    <div class="portfolio-container" id="portfolioContainer">
        <!-- Portfolio items will be dynamically added here -->
    </div>

    <!-- Modal for adding/editing portfolio items -->
    <div class="modal" id="portfolioModal">
        <div class="modal-content">
            <h2 id="modalTitle">Add Portfolio Item</h2>
            <input type="text" id="portfolioTitle" placeholder="Title">
            <textarea id="portfolioDescription" placeholder="Description" rows="4"></textarea>
            <input type="text" id="portfolioImage" placeholder="Image URL">
            <input type="text" id="portfolioTech" placeholder="Technologies Used (comma separated)">
            <div>
                <button class="save-btn" onclick="savePortfolioItem()">Save</button>
                <button class="cancel-btn" onclick="closeModal()">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        let portfolioItems = [];
        let editingIndex = null;

        // Open modal for adding/editing
        function openModal(index = null) {
            const modal = document.getElementById('portfolioModal');
            const modalTitle = document.getElementById('modalTitle');
            const portfolioTitle = document.getElementById('portfolioTitle');
            const portfolioDescription = document.getElementById('portfolioDescription');
            const portfolioImage = document.getElementById('portfolioImage');
            const portfolioTech = document.getElementById('portfolioTech');

            if (index !== null) {
                // Editing an existing item
                modalTitle.textContent = "Edit Portfolio Item";
                portfolioTitle.value = portfolioItems[index].title;
                portfolioDescription.value = portfolioItems[index].description;
                portfolioImage.value = portfolioItems[index].image;
                portfolioTech.value = portfolioItems[index].tech.join(", ");
                editingIndex = index;
            } else {
                // Adding a new item
                modalTitle.textContent = "Add Portfolio Item";
                portfolioTitle.value = "";
                portfolioDescription.value = "";
                portfolioImage.value = "";
                portfolioTech.value = "";
                editingIndex = null;
            }

            modal.style.display = "flex";
        }

        // Close modal
        function closeModal() {
            document.getElementById('portfolioModal').style.display = "none";
        }

        // Save portfolio item
        function savePortfolioItem() {
            const title = document.getElementById('portfolioTitle').value;
            const description = document.getElementById('portfolioDescription').value;
            const image = document.getElementById('portfolioImage').value;
            const tech = document.getElementById('portfolioTech').value.split(",").map(t => t.trim());

            if (title && description && image && tech.length > 0) {
                const portfolioItem = { title, description, image, tech };

                if (editingIndex !== null) {
                    // Update existing item
                    portfolioItems[editingIndex] = portfolioItem;
                } else {
                    // Add new item
                    portfolioItems.push(portfolioItem);
                }

                renderPortfolioItems();
                closeModal();
            } else {
                alert("Please fill in all fields.");
            }
        }

        // Delete portfolio item
        function deletePortfolioItem(index) {
            portfolioItems.splice(index, 1);
            renderPortfolioItems();
        }

        // Render portfolio items
        function renderPortfolioItems() {
            const portfolioContainer = document.getElementById('portfolioContainer');
            portfolioContainer.innerHTML = "";

            portfolioItems.forEach((item, index) => {
                const portfolioItem = document.createElement('div');
                portfolioItem.className = "portfolio-item";
                portfolioItem.innerHTML = `
                    <img src="${item.image}" alt="${item.title}">
                    <div class="portfolio-item-content">
                        <h3>${item.title}</h3>
                        <p>${item.description}</p>
                        <div class="tech-used">Technologies: ${item.tech.join(", ")}</div>
                        <div class="portfolio-item-actions">
                            <button class="edit-btn" onclick="openModal(${index})">Edit</button>
                            <button class="delete-btn" onclick="deletePortfolioItem(${index})">Delete</button>
                        </div>
                    </div>
                `;
                portfolioContainer.appendChild(portfolioItem);
            });
        }

        // Initial render
        renderPortfolioItems();
    </script>
</body>
</html>