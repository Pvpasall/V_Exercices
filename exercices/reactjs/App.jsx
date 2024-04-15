import React, { useState, useEffect } from 'react';

export function InscriptionNewsletter() {
    const [email, setEmail] = useState('');
    const [message, setMessage] = useState('');
    const validateEmail = (email) => {
        // Utilisation de l'expression régulière pour valider l'adresse email
        return /\S+@\S+\.\S+/.test(email);
    };

    useEffect(() => {
        if (!validateEmail(email)) {
            setMessage('Adresse email invalide.');
        } else {
            setMessage(`Merci de vous être inscrit avec l'adresse : ${email}`);
        }
    }, [email]);

    const handleSoumettre = e => {
        e.preventDefault();
    };


    return (
        <div>
            <form onSubmit={handleSoumettre}>
                <input
                    type="text"
                    placeholder="Entrez votre email"
                    value={email}
                    onChange={e => setEmail(e.target.value)}
                />
                <button type="submit">Inscrire</button>
            </form>
            {message && <p>{message}</p>}
        </div>
    );
}