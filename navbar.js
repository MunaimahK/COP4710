class NarbarComponent extends HTMLElement {
  constructor() {
    super();
    this._loggedIn = false; // Default value
  }

  static get observedAttributes() {
    return ["logged-in"];
  }

  get loggedIn() {
    return this._loggedIn;
  }

  set loggedIn(value) {
    this._loggedIn = Boolean(value);
    this.render();
  }

  connectedCallback() {
    this.render();
  }

  attributeChangedCallback(name, oldValue, newValue) {
    if (name === "logged-in") {
      this.loggedIn = newValue !== null;
    }
  }

  render() {
    if (!this.loggedIn) {
      this.innerHTML = `
    <div class="nav">
      <nav>
          <div class="nav">
            <a href="/signup.php">Register </a>
            <a href="/login.php">Login </a>
          </div>
      </nav>
    </div>
    `;
    } else {
      this.innerHTML = `
      <div class="nav">
          <nav>
              <div class="nav">
                <a href="/ship-register.php">Ship Registration </a>
                <a href="/port-entry.php">Port Entry </a>
                <a href="/port-exit.php">Port Exit </a>
                <a href="/crane-operator.php">Crane Operator</a>
                <a href="/truck-registration.php">Truck Registration</a>
                <a href="/truck-driver-registration.php">Truck Driver Registration</a>
                <a href="/container-registration.php">Container Registration</a>
                <a href="/port-admin-management.php">Port Admin</a>
              </div>
          </nav>
        </div>
      `;
    }
  }
}

customElements.define("navbar-component", NarbarComponent);
