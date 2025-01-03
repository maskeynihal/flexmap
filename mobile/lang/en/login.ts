const lang = {
  login: {
    email: {
      required: "Email is required.",
      label: "Email",
    },
    password: {
      required: "Password is required.",
      label: "Password",
    },
    firstName: {
      required: "First name is required.",
      label: "First name",
    },
    lastName: {
      required: "Last name is required.",
      label: "Last name",
    },
    confirmPassword: {
      required: "Confirm password is required.",
      matches: "Passwords do not match. Please reverify.",
      label: "Confirm password",
    },
  },
} as const;

export default lang;
