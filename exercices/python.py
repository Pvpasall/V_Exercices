# def premier_caractere_repete(chaine):
#     vu = {}
#     for caractere in chaine:
#         if caractere.lower() in vu:
#             return caractere
#         else:
#             vu[caractere.lower()] = True
#     return None


# # Test de la fonction
# print(premier_caractere_repete("abcdedcba"))


def premier_caractere_repete(chaine):
    vu = set()
    for caractere in chaine:
        if caractere in vu:
            return caractere
        else:
            vu.add(caractere)
    return None


def dernier_caractere_repete(chaine):
    vu = []
    chaine = chaine.lower()
    for caractere in chaine:
        vu.append(caractere)
        freq = vu.count(caractere)
        if freq > 1:
            dernier_caractere_rep = caractere

    return (dernier_caractere_rep, freq) if freq > 1 else None


# Test de la fonction
# print(premier_caractere_repete("abcdedcba"))
print(dernier_caractere_repete("abcdedcba"))
