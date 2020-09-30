async function removeComment(e, id) {
    const res = await fetch(`https://127.0.0.1:8000/api/comments/${id}`, {
        method: 'DELETE'    
    });
    e.parentNode.remove();
}