import React from "react";
import { View, Image, StyleSheet, TextInput } from "react-native";

import {
  Container,
  Header,
  Content,
  List,
  ListItem,
  Thumbnail,
  Text,
  Left,
  Body,
  Right,
  Button
} from "native-base";

import { createStackNavigator } from "react-navigation";

class HomeScreen extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      formLabel1: "Your Company Name",
      formLabel2: "Your Staff ID"
    };
  }
  render() {
    return (
      <View style={styles.mainContainer}>
        <Text
          style={{ width: 200, height: 100, fontWeight: "bold", color: "red" }}
        >
          IonicBond
        </Text>
        <Image
          style={{ width: 200, height: 200 }}
          source={require("./assets/logo.png")}
        />
        <TextInput
          style={{
            height: 30,
            width: 193,
            borderColor: "gray",
            borderWidth: 2
          }}
          onChangeText={text => this.setState({ text })}
          value={this.state.formLabel1}
        />

        <TextInput
          style={{
            height: 30,
            width: 193,
            borderColor: "gray",
            borderWidth: 1
          }}
          onChangeText={text => this.setState({ text })}
          value={this.state.formLabel2}
        />

        <Button
          style={{ alignItems: "center" }}
          transparent
          onPress={() => this.props.navigation.navigate("Details")}
        >
          <Text>Sign In</Text>
        </Button>

        {/* <Button
          title="Sign In"
          onPress={() => this.props.navigation.navigate("Details")}
        /> */}
        <Text
          style={styles.textLinks}
          onPress={() => console.log("Terms and Conditions Pressed!")}
        >
          Terms and Conditions
        </Text>
        <Text
          style={styles.textLinks}
          onPress={() => console.log("Privacy Policy pressed!")}
        >
          Privacy Policy
        </Text>
      </View>
    );
  }
}

class DetailsScreen extends React.Component {
  render() {
    return (
      <Container>
        <Header />
        <Content>
          <List>
            <ListItem thumbnail>
              <Left>
                <Thumbnail
                  square
                  source={require("./assets/coffee_break.jpg")}
                />
              </Left>
              <Body>
                <Text> 'Coffee Icebreaker'</Text>
                <Text note numberOfLines={1}>
                  'Let us get together to explore the cafes where everyone feels
                  at ease to just enjoy good food good coffee and g ood
                  company.'
                </Text>
              </Body>
              <Right>
                <Button
                  transparent
                  onPress={() => this.props.navigation.navigate("Activity")}
                >
                  <Text>View</Text>
                </Button>
              </Right>
            </ListItem>

            <ListItem thumbnail>
              <Left>
                <Thumbnail square source={require("./assets/laser_tag.jpg")} />
              </Left>
              <Body>
                <Text> 'Laser Tag' </Text>
                <Text note numberOfLines={1}>
                  'An amazing group game based on tag with a twist. Talk about
                  having Star Wars in your Office Complex! '
                </Text>
              </Body>
              <Right>
                <Button
                  transparent
                  onPress={() => this.props.navigation.navigate("Activity")}
                >
                  <Text>View</Text>
                </Button>
              </Right>
            </ListItem>

            <ListItem thumbnail>
              <Left>
                <Thumbnail
                  square
                  source={require("./assets/basket_ball.jpg")}
                />
              </Left>
              <Body>
                <Text>'Chinatown Walking Trails'</Text>
                <Text note numberOfLines={1}>
                  'Come and join us for a healthy game of basketball where sweat
                  fun and laughter meet.'
                </Text>
              </Body>
              <Right>
                <Button transparent>
                  <Text>View</Text>
                </Button>
              </Right>
            </ListItem>

            <ListItem thumbnail>
              <Left>
                <Thumbnail
                  square
                  source={require("./assets/cooking_class.jpg")}
                />
              </Left>
              <Body>
                <Text> 'Cooking Class + Potluck Party'</Text>
                <Text note numberOfLines={1}>
                  'Come and learn from the experienced chefs. Each cooking class
                  will have different theme and it would be a great
                </Text>
              </Body>
              <Right>
                <Button
                  transparent
                  onPress={() => this.props.navigation.navigate("Details")}
                >
                  <Text>View</Text>
                </Button>
              </Right>
            </ListItem>
          </List>
        </Content>
      </Container>
    );
  }
}

class ActivityScreen extends React.Component {
  render() {
    return (
      <View>
        <Text>Activity Name</Text>
        <Image
          style={{ width: 200, height: 75 }}
          source={require("./assets/cooking_class.jpg")}
        />
        <Text>Date and Time</Text>
      </View>
    );
  }
}

const RootStack = createStackNavigator(
  {
    Home: HomeScreen,
    Details: DetailsScreen,
    Activity: ActivityScreen
  },
  {
    initialRouteName: "Home"
  }
);

export default class App extends React.Component {
  render() {
    return <RootStack />;
  }
}

const styles = StyleSheet.create({
  mainContainer: {
    alignItems: "center",
    flex: 1,
    justifyContent: "center"
  },
  textLinks: {
    color: "#E91E63",
    textDecorationLine: "underline"
  }
});
