async function removeComment(id) {
    const res = await fetch(`https://127.0.0.1:8000/api/comments/${id}`, {
        method: 'DELETE'
    }).then(() => location.reload());
}