// Formulaire ajout de personne
const form = document.getElementById("addPerson");
// Init les erreurs du form
const errors = {};

// Récupérer les personnes
const getPersons = () => {
  let persons = [];
  if (window.localStorage.hasOwnProperty("persons")) {
    persons = JSON.parse(window.localStorage.getItem("persons"));
  }

  return persons;
};

// Stocker les personnes
const storePersons = (persons = []) => {
  return window.localStorage.setItem("persons", JSON.stringify(persons));
};

// Afficher les messages d'erreurs
const displayErr = (form = null) => {
  let container = form;
  if (form === null || form === undefined) {
    container = document;
  }

  for (let key in errors) {
    container.querySelector(`[name="${key}"]`).classList.add("is-invalid");
    let errContainer = container.querySelector(`#${key}Feedback`);
    if (errContainer === null || errContainer === undefined) {
      errContainer = document.createElement("small");
      errContainer.classList.add("invalid-feedback");
      errContainer.id = `${key}Feedback`;
      container
        .querySelector(`[name="${key}"]`)
        .parentNode.insertAdjacentElement("beforeend", errContainer);
    }
    errContainer.innerText = errors[key];
  }

  return;
};

// Valider le formulaire si pas d'erreurs
const validate = () => {
  form.reset();
  if (form.querySelector("#nameFeedback")) {
    form.querySelector("#nameFeedback").remove();
  }
  if (form.querySelector('[name="name"]')) {
    form.querySelector('[name="name"]').classList.remove("is-invalid");
  }
};

// Ajouter une personne
const addPerson = (e) => {
  e.preventDefault();
  delete errors.name;
  const form = e.target;
  const nameField = form.querySelector("#name");
  const name = nameField.value.trim();
  const persons = getPersons();

  if (name === "" || name === null) {
    nameField?.classList.add("is-invalid");
    errors.name = "Ce champs est obligatoire !";
  }
  if (persons.includes(name)) {
    errors.name = "Cette personne existe déjà !";
  }
  if (name !== "" && Object.keys(errors).length === 0) {
    persons.push(name);
    displayPerson(name);
    storePersons(persons);
    validate();
  }
  if (Object.keys(errors).length > 0) {
    return displayErr();
  }

  displayDeleteAllButton();
  return displayTirageAuSortButton();
};

// Supprimer une personne
const deletePerson = (e, name) => {
  const persons = getPersons();
  const index = persons.findIndex((person) => person === name);
  persons.splice(index, 1);
  e.target.parentNode.remove();
  
  storePersons(persons);
  if (persons.length < 2) {
    window.localStorage.removeItem("selectedPerson");
  }
  if (window.localStorage.hasOwnProperty("selectedPerson") && persons.length > 1) {
    return tirageAuSort();
  }

  displayDeleteAllButton();
  return displayTirageAuSortButton();;
};

// Afficher une personne
const displayPerson = (name) => {
  const template = document.getElementById("personTemplate");
  const html = template.content.cloneNode(true);
  const container = document.getElementById("personsContainer");
  html.querySelector(".person-name").innerText = name;
  html
    .querySelector("i")
    .setAttribute("onclick", `deletePerson(event, '${name}')`);

  return container.appendChild(html);
};

// Afficher le bouton tirage au sort
const displayTirageAuSortButton = () => {
  const tirageAuSortButton = document.getElementById("tirageAuSort");

  return (tirageAuSortButton.style.display =
    getPersons().length > 1 ? "block" : "none");
};

// Afficher le bouton supprimer toutes les personnes
const displayDeleteAllButton = () => {
  const deleteAllButton = document.getElementById("deleteAllButton");

  return (deleteAllButton.style.display =
    getPersons().length > 0 ? "block" : "none");
};

// Charger les personnes
const loadPersons = () => {
  if (getPersons().length > 0) {
    for (const pers of getPersons()) {
      displayPerson(pers);
    }
  }
  displayTirageAuSortButton();
  displayDeleteAllButton();
  
  return displaySelected();
};

// Supprimer toutes les personnes
const deleteAllPersons = () => {
  document.getElementById("personsContainer").innerHTML = "";
  const persons = [];
  storePersons(persons);
  if (persons.length === 0) {
    window.localStorage.removeItem("selectedPerson");
  }
  return loadPersons();
};

// Tirer une personne au sort
const tirageAuSort = () => {
  const index = randomInt(0, getPersons().length);
  const name = getPersons()[index];
  window.localStorage.setItem(
    "selectedPerson",
    JSON.stringify({ index, name })
  );
  return displaySelected();
};

// Afficher la personne tirée au sort
const displaySelected = () => {
  const selectedOld = document.querySelector(".person.selected");
  const selectedPerson = getSelectedPerson();
  const htmlPersons = document.querySelectorAll(".person");
  if (selectedOld) {
    selectedOld.classList.remove("selected");
  }
  if (selectedPerson !== null) {
    return htmlPersons[selectedPerson.index].classList.add("selected");
  }
};

// Récupérer la personne tirée au sort
const getSelectedPerson = () => {
  if (window.localStorage.hasOwnProperty("selectedPerson")) {
    return JSON.parse(window.localStorage.selectedPerson);
  }

  return null;
};

// Génerer un chiffre au hasard en $min et $max
const randomInt = (min = 0, max = 999999) => {
  min = Math.ceil(min);
  max = Math.floor(max);

  return Math.floor(Math.random() * (max - min) + min); // The maximum is exclusive and the minimum is inclusive
};

window.onload = () => loadPersons();
