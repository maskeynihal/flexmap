import { View, SafeAreaView } from "react-native";

import { Link } from "expo-router";

export default function Page() {
  return (
    <SafeAreaView>
      <Link href="/login">Login</Link>
    </SafeAreaView>
  );
}
