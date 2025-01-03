import React, { useState, useContext } from "react";
import { View, StyleSheet } from "react-native";
import { TextInput, Button, Title, Text, HelperText } from "react-native-paper";
import { Controller, useForm } from "react-hook-form";
import lang from "@/lang/en/login";
import { Link } from "expo-router";

type LoginInputs = {
  email: string;
  password: string;
};

const LoginScreen = () => {
  const [showPassword, setShowPassword] = useState(false);

  const {
    register,
    control,
    formState: { errors },
    handleSubmit,
  } = useForm<LoginInputs>({
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
      <Title style={styles.title}>Login</Title>
      <Controller
        control={control}
        name="email"
        rules={{
          required: lang.login.email.required,
        }}
        render={({ field: { onChange, onBlur, value } }) => (
          <TextInput
            label="Email"
            mode="outlined"
            keyboardType="email-address"
            onBlur={onBlur}
            onChangeText={onChange}
            value={value}
            error={Boolean(errors.email)}
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
            label="Password"
            mode="outlined"
            onBlur={onBlur}
            onChangeText={onChange}
            value={value}
            secureTextEntry={!showPassword}
            error={Boolean(errors.password)}
            right={
              <TextInput.Icon
                icon={showPassword ? "eye" : "eye-off"}
                onPress={handleShowPassword}
              />
            }
            style={styles.password}
          />
        )}
      />
      {errors.password && (
        <HelperText type="error">{errors.password.message}</HelperText>
      )}

      <Button
        mode="contained"
        onPress={handleSubmit(onSubmit)}
        style={styles.button}
      >
        Login
      </Button>

      <Link href="/register" style={styles.button}>
        Don't have an account? <Text style={styles.registerText}>Register</Text>
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
});

export default LoginScreen;
