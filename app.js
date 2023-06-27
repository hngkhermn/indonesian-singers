const express = require('express');
const bodyParser = require('body-parser');
const connection = require('./config/database');
const app = express();
const PORT = process.env.PORT || 2424;

app.set('view engine', 'ejs');


app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

// post data | penyanyi indonesia
app.post('/api/penyanyi', (req, res) => {
    const data = { ...req.body };
    const querySql = 'INSERT INTO indonesian_singers SET ?';

    connection.query(querySql, data, (err, rows, field) => {
        if (err) {
            return res.status(500).json({ message: 'Data not inserted!', error: err });
        }
        res.status(201).json({ success: true, message: 'Data has been inserted!' });
    });
});

// read data | penyanyi indonesia
app.get('/api/penyanyi', (req, res) => {
    const querySql = "SELECT * FROM indonesian_singers";


    connection.query(querySql, (err, rows, field) => {
        if (err) {
            return res.status(500).json({ message: 'Ada kesalahan', error: err });
        }

        res.status(200).json({ success: true, data: rows });
    });
});

// update data | penyanyi indonesia
app.put('/api/penyanyi/:id', (req, res) => {
    const data = { ...req.body };
    const querySearch = 'SELECT * FROM indonesian_singers WHERE id = ?';
    const queryUpdate = 'UPDATE indonesian_singers SET ? WHERE id = ?';

    connection.query(querySearch, req.params.id, (err, rows, field) => {
        if (err) {
            return res.status(500).json({ message: 'Ada kesalahan', error: err });
        }

        if (rows.length) {
            connection.query(queryUpdate, [data, req.params.id], (err, rows, field) => {
                if (err) {
                    return res.status(500).json({ message: 'Ada kesalahan', error: err });
                }

                res.status(200).json({ success: true, message: 'Data has been updated!' });
            });
        } else {
            return res.status(404).json({ message: 'Data not found!', success: false });
        }
    });
});


app.get('/api/penyanyi/:id', (req, res) => {
    const data = { ...req.body };
    const querySearch = "SELECT * FROM indonesian_singers WHERE id = ?";
    const birthQuery = "SELECT * FROM indonesian_singers WHERE birth LIKE ?";
    const genreQuery = "SELECT * FROM indonesian_singers WHERE genre LIKE ?";
    const musicQuery = "SELECT * FROM indonesian_singers WHERE music LIKE ?" ;
    const nameQuery = "SELECT * FROM indonesian_singers WHERE name LIKE ?" ;
    const debutQuery = "SELECT * FROM indonesian_singers WHERE debut LIKE ?" ;

    if (!isNaN(req.params.id)) {
        connection.query(querySearch, req.params.id, (err, rows, field) => {
            if (err) {
                return res.status(500).json({ message: 'Ada kesalahan', error: err });
            }

            if (rows.length) {
                res.status(200).json({ success: true, data: rows });
            } else {
                return res.status(404).json({ message: 'Data not found!', success: false });
            }
        });
    } else if (req.params.id.toLowerCase() === 'genre') {
        const genre = '%' + req.query.value + '%';

        connection.query(genreQuery, genre, (err, rows, field) => {
            if (err) {
                return res.status(500).json({ message: 'Ada kesalahan', error: err });
            }

            if (rows.length) {
                res.status(200).json({ success: true, data: rows });
            } else {
                return res.status(404).json({ message: 'Data not found!', success: false });
            }
        });
    } else if (req.params.id.toLowerCase() === 'music') {
        const music = '%' + req.query.value + '%';
        connection.query(musicQuery, music, (err, rows, field) => {
            if (err) {
                return res.status(500).json({ message: 'Ada kesalahan', error: err });
            }

            if (rows.length) {
                res.status(200).json({ success: true, data: rows });
            } else {
                return res.status(404).json({ message: 'Data not found!', success: false });
            }
        });   
    } else if (req.params.id.toLowerCase() === 'name') {
        const name = '%' + req.query.value + '%';
        connection.query(nameQuery, name, (err, rows, field) => {
            if (err) {
                return res.status(500).json({ message: 'Ada kesalahan', error: err });
            }

            if (rows.length) {
                res.status(200).json({ success: true, data: rows });
            } else {
                return res.status(404).json({ message: 'Data not found!', success: false });
            }
        });   
    } else if (req.params.id.toLowerCase() === 'debut') {
        const debut = '%' + req.query.value + '%';
        connection.query(debutQuery, debut, (err, rows, field) => {
            if (err) {
                return res.status(500).json({ message: 'Ada kesalahan', error: err });
            }

            if (rows.length) {
                res.status(200).json({ success: true, data: rows });
            } else {
                return res.status(404).json({ message: 'Data not found!', success: false });
            }
        });   
    } else if (req.params.id.toLowerCase() === 'birth') {
        const birth = '%' + req.query.value + '%';
        connection.query(birthQuery, birth, (err, rows, field) => {
            if (err) {
                return res.status(500).json({ message: 'Ada kesalahan', error: err });
            }

            if (rows.length) {
                res.status(200).json({ success: true, data: rows });
            } else {
                return res.status(404).json({ message: 'Data not found!', success: false });
            }
        });   
    }
    
    else {
        return res.status(400).json({ message: 'Invalid search criteria!', success: false });
    }
});


// delete data | penyanyi indonesia
app.delete('/api/penyanyi/:id', (req, res) => {
    const querySearch = 'SELECT * FROM indonesian_singers WHERE id = ?';
    const queryDelete = 'DELETE FROM indonesian_singers WHERE id = ?';

    connection.query(querySearch, req.params.id, (err, rows, field) => {
        if (err) {
            return res.status(500).json({ message: 'Ada kesalahan', error: err });
        }

        if (rows.length) {
            connection.query(queryDelete, req.params.id, (err, rows, field) => {
                if (err) {
                    return res.status(500).json({ message: 'Ada kesalahan', error: err });
                }

                res.status(200).json({ success: true, message: 'Data has been deleted!' });
            });
        } else {
            return res.status(404).json({ message: 'Data not found!', success: false });
        }
    });
});



app.listen(PORT, () => console.log(`Server running at port :${PORT}`));
