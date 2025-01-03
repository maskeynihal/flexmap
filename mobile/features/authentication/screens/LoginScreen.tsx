import React, { useState, useContext } from "react";
import { View, StyleSheet } from "react-native";
import { TextInput, Button, Title, Text, HelperText } from "react-native-paper";
import { AuthContext } from "../AuthContext";
import { Controller, useForm } from "react-hook-form";
import lang from "@/lang/en/login";

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
    <View style={styles.container}>
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
      <Button
        mode="text"
        // onPress={() => navigation.navigate("Register")}
        style={styles.button}
      >
        Don't have an account? Register
      </Button>
    </View>
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
});

export default LoginScreen;
