<div class="card">
    <div class="card-body">
        <h3>Create new ticket</h3>
        <form id="ticket">
            <label for="summary" class="form-label">Summary</label>
            <input type="text" class="form-control" id="summary" aria-describedby="summary" maxlength="100">
            <label for="description" class="form-label">Description</label>
            <textarea type="text" class="form-control" id="description" aria-describedby="description" rows="10"></textarea>
            <div class="mt-3 text-end">
                <button type="submit" class="btn btn-primary" id="createBtn">Create</button>
            </div>
        </form>
    </div>
</div>