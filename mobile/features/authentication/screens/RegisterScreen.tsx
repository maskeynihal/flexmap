import React, { useState, useContext } from "react";
import { View, StyleSheet } from "react-native";
import { TextInput, Button, Title, Text, HelperText } from "react-native-paper";
import { Controller, useForm } from "react-hook-form";
import lang from "@/lang/en/login";
import { Link } from "expo-router";
import { sizes } from "@/config/designTokens";

type RegisterInputs = {
  firstName: string;
  lastName: string;
  email: string;
  password: string;
  confirmPassword: string;
};

const RegisterScreen = () => {
  const [showPassword, setShowPassword] = useState(false);

  const {
    register,
    control,
    formState: { errors },
    handleSubmit,
    watch,
  } = useForm<RegisterInputs>({
    defaultValues: {
      email: "",
      password: "",
    },
  });

  const onSubmit = (data) => console.log(data);

  function handleShowPassword() {
    setShowPassword((previousShowPassword) => !previousShowPassword);
  }

  // const { setIsLoggedIn } = useContext(AuthContext);

  // const handleLogin = () => {
  //   // Implement login logic here
  //   console.log("Login with", email, password);
  //   setIsLoggedIn(true);
  // };

  return (
    <>
      <Title style={styles.title}>Register</Title>
      <Controller
        control={control}
        name="firstName"
        rules={{
          required: lang.login.firstName.required,
        }}
        render={({ field: { onChange, onBlur, value } }) => (
          <TextInput
            label={lang.login.firstName.label}
            mode="outlined"
            onBlur={onBlur}
            onChangeText={onChange}
            value={value}
            error={Boolean(errors.firstName)}
          />
        )}
      />
      {errors.firstName && (
        <HelperText type="error">{errors.firstName.message}</HelperText>
      )}

      <Controller
        control={control}
        name="lastName"
        rules={{
          required: lang.login.lastName.required,
        }}
        render={({ field: { onChange, onBlur, value } }) => (
          <TextInput
            label={lang.login.lastName.label}
            mode="outlined"
            onBlur={onBlur}
            onChangeText={onChange}
            value={value}
            error={Boolean(errors.lastName)}
            style={styles.inputBox}
          />
        )}
      />
      {errors.lastName && (
        <HelperText type="error">{errors.lastName.message}</HelperText>
      )}

      <Controller
        control={control}
        name="email"
        rules={{
          required: lang.login.email.required,
        }}
        render={({ field: { onChange, onBlur, value } }) => (
          <TextInput
            label={lang.login.email.label}
            mode="outlined"
            onBlur={onBlur}
            onChangeText={onChange}
            value={value}
            error={Boolean(errors.email)}
            style={styles.inputBox}
          />
        )}
      />
      {errors.email && (
        <HelperText type="error">{errors.email.message}</HelperText>
      )}

      <Controller
        control={control}
        name="password"
        rules={{
          required: lang.login.password.required,
        }}
        render={({ field: { onChange, onBlur, value } }) => (
          <TextInput
            label={lang.login.password.label}
            mode="outlined"
            onBlur={onBlur}
            onChangeText={onChange}
            value={value}
            error={Boolean(errors.password)}
            secureTextEntry={!showPassword}
            style={styles.inputBox}
            right={
              <TextInput.Icon
                icon={showPassword ? "eye" : "eye-off"}
                onPress={handleShowPassword}
              />
            }
          />
        )}
      />
      {errors.password && (
        <HelperText type="error">{errors.password.message}</HelperText>
      )}

      <Controller
        control={control}
        name="confirmPassword"
        rules={{
          required: lang.login.confirmPassword.required,
          validate: (value) =>
            value === watch("password") || lang.login.confirmPassword.matches,
        }}
        render={({ field: { onChange, onBlur, value } }) => (
          <TextInput
            label={lang.login.confirmPassword.label}
            mode="outlined"
            onBlur={onBlur}
            onChangeText={onChange}
            value={value}
            error={Boolean(errors.confirmPassword)}
            style={styles.inputBox}
            secureTextEntry={!showPassword}
            right={
              <TextInput.Icon
                icon={showPassword ? "eye" : "eye-off"}
                onPress={handleShowPassword}
              />
            }
          />
        )}
      />
      {errors.confirmPassword && (
        <HelperText type="error">{errors.confirmPassword.message}</HelperText>
      )}

      <Button
        mode="contained"
        onPress={handleSubmit(onSubmit)}
        style={styles.button}
      >
        Register
      </Button>

      <Link href="/login" style={styles.button}>
        Already have an account? <Text style={styles.registerText}>Login</Text>
      </Link>
    </>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    padding: 16,
    justifyContent: "center",
  },
  title: {
    fontSize: 24,
    marginBottom: 24,
    textAlign: "center",
  },
  password: {
    marginTop: 8,
  },
  button: {
    marginTop: 8,
  },
  registerText: {
    textDecorationLine: "underline",
  },
  inputBox: {
    marginTop: sizes.base,
  },
});

export default RegisterScreen;
